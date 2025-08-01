<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleLike;
use App\Models\ArticleSave;
use App\Models\ArticleView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleApi extends Controller
{
    public function makeComment()
    {
        $comment = request()->comment;
        $article_id = request()->article_id;
        $user = auth()->user();
        $created = ArticleComment::create([
            'article_id' => $article_id,
            'user_id' => $user->id,
            'author_name' => $user->name,
            'comment' => $comment,
        ]);
        $data = ArticleComment::where('id', $created->id)->with('user')->first();
        return response()->json($data);
    }

    public function like(Request $request)
    {
        $user = auth()->user();
        $articleId = $request->id;

        $alreadyLiked = ArticleLike::where('user_id', $user->id)
            ->where('article_id', $articleId)
            ->exists();

        if ($alreadyLiked) {
            return 'already_liked';
        }

        ArticleLike::create([
            'user_id' => $user->id,
            'article_id' => $articleId,
        ]);

        Article::where('id', $articleId)->increment('like_count');

        return 'success';
    }

    public function save()
    {
        $id = request()->id;
        $findArticle = Article::where('id', $id)->first();
        $checkAlreadySaved = ArticleSave::where('user_id', auth()->id())
            ->where('article_id', $findArticle->id)
            ->first();
        if ($checkAlreadySaved) {
            return 'already_saved';
        }
        ArticleSave::create([
            'user_id' => auth()->id(),
            'article_id' => $findArticle->id,
        ]);
        return 'success';
    }

    public function getSave()
    {
        $user = auth()->user();
        $savedArticles = ArticleSave::where('user_id', $user->id)
            ->with('article')
            ->get();

        return response()->json($savedArticles);
    }
}
