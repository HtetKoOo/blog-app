<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Programming;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programmings = Programming::all();
        $tags = Tag::all();
        return view('backend.article.create', compact('programmings', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:30',
            'image' => 'required|max:10240',
            'description' => 'required|string',
        ]);

        $file = $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);

        $createdArticle = Article::create([
            'title' => $request->title,
            'image' => $file_name,
            'description' => strip_tags($request->description),
            'like_count' => 0,
            'view_count' => 0,
        ]);

        $article = Article::find($createdArticle->id);
        $article->tag()->sync($request->tag);
        $article->programming()->sync($request->programming);

        return redirect('admin/article')->with('success', 'Successfully Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::with('tag', 'programming')->findOrFail($id);
        $tags = Tag::all();
        $programmings = Programming::all();
        return view('backend.article.edit', compact('article', 'tags', 'programmings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);
        $request->validate([
            'title' => 'string|max:30',
            'image' => 'nullable|max:10240',
            'description' => 'string',
        ]);
        if ($file = $request->file('image')) {
            File::delete(public_path('/images/' . $article->image)); // Delete the old image file
            $file_name = uniqid() . $file->getClientOriginalName();
            $file->move(public_path('/images'), $file_name);
        }else{
            $file_name = $article->image; // Keep the old image if no new file is uploaded
        }
        $article->update([
            'title' => $request->title,
            'image' => $file_name,
            'description' => strip_tags($request->description),
        ]);
        $article->tag()->sync($request->tag);
        $article->programming()->sync($request->programming);

        return redirect('admin/article')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        File::delete(public_path('/images/' . $article->image)); // Delete the image file
        $article->tag()->sync([]); // Detach all tags
        $article->programming()->sync([]); // Detach all programmings
        $article->delete();
        return redirect()->back()->with('success', 'Article deleted successfully.');
    }
}
