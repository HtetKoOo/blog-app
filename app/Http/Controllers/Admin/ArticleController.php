<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Programming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ArticleController extends Controller
{

    public function index()
    {
        $data = Article::orderBy('id', 'desc')
            ->with('tag', 'programming')
            ->paginate(10);
        return view('backend.article.index', compact('data'));
    }

    public function detail($id)
    {
        $article = Article::with('tag', 'programming')->findOrFail($id);
        return response()->json($article);
    }

    public function ssd()
    {
        $data = Article::query();

        return DataTables::of($data)
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($each) {
                $detail_icon = '<a href="#" class="text-success detail" data-id="' . $each->id . '"><i class="fas fa-eye"></i></a>';
                $edit_icon = '<a href="' . url('admin/article/' . $each->id . '/edit') . '" class="text-warning"><i class="fas fa-edit"></i></a>';
                $delete_icon = '<button type="button" class="btn btn-link text-danger p-0 delete-article" data-id="' . $each->id . '" data-image="' . $each->image . '">
                <i class="fas fa-trash-alt"></i>
                </button>';
                return '<div class="action-icon">' . $detail_icon . $edit_icon . $delete_icon . '</div>';
            })
            ->make(true);
    }

    public function create()
    {
        $programmings = Programming::all();
        $tags = Tag::all();
        return view('backend.article.create', compact('programmings', 'tags'));
    }

    public function store(Request $request)
    {
        if(!$request->hasFile('image')) {
            return redirect()->back()->withErrors(['image' => 'Image is required']);
        }
        $request->validate([
            'title' => 'required|string|max:30',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'description' => 'required|string',
        ]);


        // Upload image to Cloudinary
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();

        // Save article
        $createdArticle = Article::create([
            'title' => $request->title,
            'image' => $uploadedFileUrl, // Save only the path
            'description' => strip_tags($request->description),
            'like_count' => 0,
            'view_count' => 0,
        ]);

        // Sync tags and programming
        $createdArticle->tag()->sync($request->tag);
        $createdArticle->programming()->sync($request->programming);

        return redirect('admin/article')->with('success', 'Successfully Created');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $article = Article::with('tag', 'programming')->findOrFail($id);
        $tags = Tag::all();
        $programmings = Programming::all();
        return view('backend.article.edit', compact('article', 'tags', 'programmings'));
    }

    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $request->validate([
            'title' => 'string|max:30',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'description' => 'string',
        ]);
        if ($request->file('image')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        } else {
            $uploadedFileUrl = $article->image; // keep old image
        }
        $article->update([
            'title' => $request->title,
            'image' => $uploadedFileUrl,
            'description' => strip_tags($request->description),
        ]);
        $article->tag()->sync($request->tag);
        $article->programming()->sync($request->programming);

        return redirect('admin/article')->with('success', 'Successfully Updated');
    }

    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        // Delete image from Cloudinary
        if ($article->image) {
            Cloudinary::destroy($article->image); // Use public_id, not URL
        }
        $article->tag()->sync([]); // Detach all tags
        $article->programming()->sync([]); // Detach all programmings
        $article->delete();
        return redirect()->back()->with('success', 'Article deleted successfully.');
    }
}
