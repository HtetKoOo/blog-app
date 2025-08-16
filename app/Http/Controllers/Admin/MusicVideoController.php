<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MusicGenre;
use App\Models\MusicVideo;
use App\Models\Singer;
use Yajra\DataTables\Facades\DataTables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MusicVideoController extends Controller
{

    public function index()
    {
        $mv = MusicVideo::orderBy('id', 'desc')
            ->paginate(10);
        return view('backend.music_video.index', compact('mv'));
    }

    public function detail($id)
    {
        $mv = MusicVideo::with(['singer', 'genre'])->findOrFail($id);

        return response()->json([
            'id' => $mv->id,
            'title' => $mv->title,
            'description' => $mv->description ?? '-',
            'thumbnail_url' => $mv->thumbnail_url ?? null,
            'music_url' => $mv->music_url ?? null,
            'singers' => $mv->singer ? $mv->singer->pluck('name')->toArray() : [],
            'genres' => $mv->genre ? $mv->genre->pluck('name')->toArray() : [],
            'video_link' => $mv->video_link ?? '-',
        ]);
    }

    public function ssd()
    {
        $mv = MusicVideo::query();

        return DataTables::of($mv)
            ->addColumn('singer', function ($each) {
                // join all singer names into one string
                return $each->singer->pluck('name')->join(', ');
            })
            ->addColumn('music_url', function ($each) {
                if ($each->music_url) {
                    return '<button 
                    class="btn btn-sm btn-primary play-audio" 
                    data-url="' . e($each->music_url) . '">
                     <i class="fas fa-music"></i> Listen
                </button>';
                }
                return '-';
            })
            ->addColumn('file_size', function ($each) {
                if ($each->music_url) {
                    try {
                        // Get file size from the URL
                        $headers = get_headers($each->music_url, 1);
                        if (isset($headers['Content-Length'])) {
                            $size = (int) $headers['Content-Length']; // in bytes
                            // Convert to KB or MB
                            if ($size >= 1048576) {
                                return round($size / 1048576, 2) . ' MB';
                            } elseif ($size >= 1024) {
                                return round($size / 1024, 2) . ' KB';
                            } else {
                                return $size . ' bytes';
                            }
                        }
                    } catch (\Exception $e) {
                        return '-';
                    }
                }
                return '-';
            })
            ->addColumn('action', function ($each) {
                $detail_icon = '<a href="#" class="text-success detail" data-id="' . $each->id . '"><i class="fas fa-eye"></i></a>';
                $edit_icon = '<a href="' . url('admin/music-video/' . $each->id . '/edit') . '" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<button type="button" class="btn btn-link text-danger p-0 delete-mv" data-id="' . $each->id . '" data-image="' . $each->image . '">
                <i class="fas fa-trash-alt"></i>
                </button>';
                return '<div class="action-icon">' . $detail_icon . $edit_icon . $delete_icon . '</div>';
            })
            ->rawColumns(['music_url', 'action'])
            ->make(true);
    }

    public function create()
    {
        $singers = Singer::all();
        $mgs = MusicGenre::all();
        return view('backend.music_video.create', compact('singers', 'mgs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:30',
            'singer' => 'required|array|min:1',
            'mg' => 'required|array|min:1',
            'music' => 'required|file|mimes:mp3',
            'video_link'  => 'nullable',
            'description' => 'nullable',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        // Initialize variables
        $musicUrl = null;
        $uploadedImage = null;

        // Upload music file to Cloudinary
        $uploadedMusic = Cloudinary::uploadFile($request->file('music')->getRealPath(), ['resource_type' => 'video']);

        $response = $uploadedMusic->getResponse();
        $musicUrl  = $response['secure_url'] ?? null;
        // Duration: round to whole seconds so Postgres INT accepts it

        // Upload image to Cloudinary
        $uploadedImage = Cloudinary::upload($request->file('photo')->getRealPath())->getSecurePath();

        // Save to database
        $createdMV = MusicVideo::create([
            'title' => $request->title,
            'description' => $request->description ?? null,
            'thumbnail_url' => $uploadedImage,
            'music_url' => $musicUrl,
            'video_link' => $request->video_link ?? null,
        ]);

        $createdMV->singer()->sync($request->singer);
        $createdMV->genre()->sync($request->mg);

        return redirect('admin/music-video')->with('success', 'Successfully Created Music Video');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $mv = MusicVideo::with('singer', 'genre')->findOrFail($id);
        $singers = Singer::all();
        $mgs = MusicGenre::all();
        return view('backend.music_video.edit', compact('mv', 'singers', 'mgs'));
    }

    public function update(Request $request, string $id)
    {
        $mv = MusicVideo::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:30',
            'singer' => 'required|array|min:1',
            'mg' => 'required|array|min:1',
            'music' => 'nullable|file|mimes:mp3',
            'video_link'  => 'nullable',
            'description' => 'nullable',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png',
        ]);
        $musicUrl = $mv->music_url;
        $uploadedImage = $mv->thumbnail_url;
        if ($request->hasFile('music')) {
            if ($mv->music_url) {
                $publicId = pathinfo(parse_url($mv->music_url, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId, ['resource_type' => 'video']);
            }
            // Upload music file to Cloudinary
            $uploadedMusic = Cloudinary::uploadFile($request->file('music')->getRealPath(), ['resource_type' => 'video']);

            $response = $uploadedMusic->getResponse();
            $musicUrl  = $response['secure_url'] ?? null;
        }
        if ($request->hasFile('photo')) {
            if ($mv->thumbnail_url) {
                $publicId = pathinfo(parse_url($mv->thumbnail_url, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }
            $uploadedImage = Cloudinary::upload($request->file('photo')->getRealPath())->getSecurePath();
        }
        // Update safely
        $mv->update([
            'title' => $request->title,
            'description' => $request->description ?? null,
            'thumbnail_url' => $uploadedImage,
            'music_url' => $musicUrl,
            'video_link' => $request->video_link ?? null,
        ]);
        // Sync relations safely
        $mv->singer()->sync($request->singer ?? []);
        $mv->genre()->sync($request->mg ?? []);
        return redirect('admin/music-video')->with('success', 'Successfully Updated Music Video');
    }

    public function destroy(string $id)
    {
        $mv = MusicVideo::findOrFail($id);

        // Delete music from Cloudinary (audio is considered a video resource)
        if ($mv->music_url) {
            $publicId = pathinfo(parse_url($mv->music_url, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy($publicId, ['resource_type' => 'video']);
        }

        // Delete image from Cloudinary
        if ($mv->thumbnail_url) {
            $publicId = pathinfo(parse_url($mv->thumbnail_url, PHP_URL_PATH), PATHINFO_FILENAME);
            Cloudinary::destroy($publicId);
        }

        // Detach relations
        $mv->singer()->sync([]);
        $mv->genre()->sync([]);

        // Delete the record
        $mv->delete();

        return redirect()->back()->with('success', 'Music video deleted successfully.');
    }
}
