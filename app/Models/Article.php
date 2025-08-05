<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];
    use HasFactory;
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        // If the image is already a full URL (Cloudinary, S3, etc.), return it as is.
        if ($this->image && filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Otherwise, return from local storage (for backward compatibility)
        return $this->image ? asset('storage/' . $this->image) : null;
    }

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

    public function likes()
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }
}
