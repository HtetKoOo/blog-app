<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ArticleComment;
use Illuminate\Http\Request;

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
}
