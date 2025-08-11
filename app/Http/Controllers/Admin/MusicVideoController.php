<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Programming;
use Illuminate\Support\Str;
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
        $mv = MusicVideo::findOrFail($id);
        // Add image_url to the response
        $mv->image_url = $mv->image_url;
        return response()->json($mv);
    }

    public function ssd()
    {
        $mv = MusicVideo::query();

        return DataTables::of($mv)
            ->addColumn('action', function ($each) {
                $detail_icon = '<a href="#" class="text-success detail" data-id="' . $each->id . '"><i class="fas fa-eye"></i></a>';
                $edit_icon = '<a href="' . url('admin/mv/' . $each->id . '/edit') . '" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<button type="button" class="btn btn-link text-danger p-0 delete-mv" data-id="' . $each->id . '" data-image="' . $each->image . '">
                <i class="fas fa-trash-alt"></i>
                </button>';
                return '<div class="action-icon">' . $detail_icon . $edit_icon . $delete_icon . '</div>';
            })
            ->make(true);
    }

    public function create()
    {
        $singers = Singer::all();
        $mgs = MusicGenre::all();
        return view('backend.music_video.create',compact('singers','mgs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:30',
            'singer' => 'required',
            'mg' => 'required',
            'music' => 'required|file|mimes:mp3',
            'video_link'  => 'nullable|string',
            'description' => 'nullable|string',
            'photo'       => 'nullable|image|mimes:jpg,jpeg,png',
            'status'      => 'required|in:0,1,2',
        ]);

        // Upload music file to Cloudinary
        $uploadedMusic = Cloudinary::uploadFile(
            $request->file('music')->getRealPath(),
            ['resource_type' => 'auto']
        );

        $musicUrl = $uploadedMusic->getSecurePath();
        $duration = $uploadedMusic->getDuration(); // seconds
        $musicSize = $uploadedMusic->getSize(); // bytes

        // Upload image to Cloudinary
        $uploadedImage = Cloudinary::upload(
            $request->file('photo')->getRealPath()
        );

        // Save to database
        $createdMV = MusicVideo::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail_url' => $uploadedImage,
            'duration' => $duration, // store as seconds
            'file_size' => $musicSize, // bytes
            'status' => $request->status,
            'music_url' => $musicUrl,
            'video_link' => $request->video_link,
        ]);

        $createdMV->singer()->sync($request->singer);
        $createdMV->mg()->sync($request->mg);

        return redirect('admin/music-video')->with('success', 'Successfully Created Music Video');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $ads = Ads::findOrFail($id);
        return view('backend.ads.edit', compact('ads'));
    }

    public function update(Request $request, string $id)
    {
        $ads = Ads::findOrFail($id);
        $request->validate([
            'title' => 'string|max:30',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);
        if ($request->file('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        } else {
            $uploadedFileUrl = $ads->image_url; // keep old image
        }
        $ads->update([
            'title' => $request->title,
            'description' => strip_tags($request->description),
            'image_url' => $uploadedFileUrl, // Save only the path
            'link' => $request->link,
            'status' => $request->status ? 1 : 0,
            'start_date' => $request->start_date ? Carbon::parse($request->start_date) : null,
            'end_date' => $request->end_date ? Carbon::parse($request->end_date) : null,
        ]);

        return redirect('admin/ads')->with('success', 'Successfully Updated Ads');
    }

    public function destroy(string $id)
    {
        $ads = Ads::findOrFail($id);
        // Delete image from Cloudinary
        if ($ads->image) {
            Cloudinary::destroy($ads->image); // Use public_id, not URL
        }
        $ads->delete();
        return redirect()->back()->with('success', 'Ads deleted successfully.');
    }
}
