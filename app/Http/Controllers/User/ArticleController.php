<?php

namespace App\Http\Controllers\User;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Programming;
use App\Models\Tag;

class ArticleController extends Controller
{
    public function all()
    {
        $tag = request()->tag;
        $programming = request()->programming;
        $data = Article::withCount('comment');
        if($tag){
            $findTag = Tag::where('id',$tag)->first();
            $data->whereHas('tag', function($q) use ($findTag) {
                $q->where('article_tags.tag_id', $findTag->id);
            });
        }
        if($programming){
            $findProgramming = Programming::where('id',$programming)->first();
            $data->whereHas('programming', function($q) use ($findProgramming) {
                $q->where('article_programmings.programming_id', $findProgramming->id);
            });
        }
        $data = $data->paginate(4);
        return view('user.article.all',compact('data'));
    }

    public function detail($id)
    {
        return view('user.article.detail', compact('id'));
    }
}
