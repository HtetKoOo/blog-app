<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Ads;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Programming;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdsController extends Controller
{

    public function index()
    {
        $ads = Ads::orderBy('id', 'desc')
            ->paginate(10);
        return view('backend.ads.index', compact('ads'));
    }

    public function detail($id)
    {
        $ads = Ads::findOrFail($id);
        // Add image_url to the response
        $ads->image_url = $ads->image_url;
        return response()->json($ads);
    }

    public function ssd()
    {
        $ads = Ads::query();

        return DataTables::of($ads)
            ->editColumn('link', function ($each) {
                return Str::limit($each->link, 30); // 👈 limits to 50 characters
            })
            ->editColumn('status', function ($each) {
                return $each->status ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($each) {
                $detail_icon = '<a href="#" class="text-success detail" data-id="' . $each->id . '"><i class="fas fa-eye"></i></a>';
                $edit_icon = '<a href="' . url('admin/ads/' . $each->id . '/edit') . '" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<button type="button" class="btn btn-link text-danger p-0 delete-ads" ads-id="' . $each->id . '" data-image="' . $each->image . '">
                <i class="fas fa-trash-alt"></i>
                </button>';
                return '<div class="action-icon">' . $detail_icon . $edit_icon . $delete_icon . '</div>';
            })
            ->make(true);
    }

    public function create()
    {
        return view('backend.ads.create');
    }

    public function store(Request $request)
    {
        if (!$request->hasFile('image')) {
            return redirect()->back()->withErrors(['image' => 'Image is required']);
        }
        $request->validate([
            'title' => 'required|string|max:30',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);

        // Upload image to Cloudinary
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

        // Save article
        Ads::create([
            'title' => $request->title,
            'description' => strip_tags($request->description),
            'image_url' => $uploadedFileUrl, // Save only the path
            'link' => $request->link,
            'status' => $request->status ? 1 : 0,
            'start_date' => $request->start_date ? Carbon::parse($request->start_date) : null,
            'end_date' => $request->end_date ? Carbon::parse($request->end_date) : null,
        ]);

        return redirect('admin/ads')->with('success', 'Successfully Created Ads');
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
        $article = Article::findOrFail($id);
        $request->validate([
            'title' => 'string|max:30',
            'image' => 'image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        ]);
        if ($request->file('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        } else {
            $uploadedFileUrl = $article->image; // keep old image
        }
        $article->update([
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
