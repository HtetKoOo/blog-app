<?php

namespace App\Http\Controllers\User;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ArticleView;
use App\Models\Programming;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function all()
    {
        $tag = request()->tag;
        $programming = request()->programming;
        $data = Article::withCount('comment');
        if ($tag) {
            $findTag = Tag::where('id', $tag)->first();
            $data->whereHas('tag', function ($q) use ($findTag) {
                $q->where('article_tags.tag_id', $findTag->id);
            });
        }
        if ($programming) {
            $findProgramming = Programming::where('id', $programming)->first();
            $data->whereHas('programming', function ($q) use ($findProgramming) {
                $q->where('article_programmings.programming_id', $findProgramming->id);
            });
        }
        if ($title = request()->title) {
            $data->where('title', 'like', "%{$title}%");
        }
        $data = $data->orderBy('id', 'desc')->paginate(4);
        return view('user.article.all', compact('data'));
    }

    public function detail($id)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('article.all')->with('error', 'You must be logged in to view this article.');
        }
        $data = Article::with('tag', 'programming', 'comment.user','views.user')->findOrFail($id);
        $checkAlreadyViewed = ArticleView::where('user_id', $user->id)
            ->where('article_id', $data->id)
            ->first();
        if (!$checkAlreadyViewed) {
            ArticleView::create([
                'user_id' => $user->id,
                'article_id' => $data->id,
            ]);
            $data->update(['view_count' => DB::raw('view_count + 1')]);
        }
        return view('user.article.detail', compact('data'));
    }
}
