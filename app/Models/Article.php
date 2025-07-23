<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];
    use HasFactory;

    public function comment()
    {
        return $this->hasMany(ArticleComment::class);
    }
    
    public function tag()
    {
        return $this->belongsToMany(Tag::class, 'article_tags');
    }
    
    public function programming()
    {
        return $this->belongsToMany(Programming::class, 'article_programmings');
    }
}
