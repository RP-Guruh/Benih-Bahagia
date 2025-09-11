<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title','slug','youtube_url','youtube_id','description','category_id','author_id'];



    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getEmbedUrlAttribute()
    {
        $url = $this->youtube_url;

        if (str_contains($url, 'watch?v=')) {
            return str_replace('watch?v=', 'embed/', $url);
        }

        if (str_contains($url, 'youtu.be/')) {
            $videoId = substr(parse_url($url, PHP_URL_PATH), 1);
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        return $url;
    }

}
