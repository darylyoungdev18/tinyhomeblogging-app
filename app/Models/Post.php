<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Post extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'title', 
        'subtitle', 
        'body', 
        'user_id', 
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function tags()
{
    return $this->belongsToMany(Tag::class);
}
public function categories()
{
    return $this->belongsToMany(Category::class);
}

// this is a data transformer to make the title a slug
protected static function booted()
{
    static::creating(function ($post) {
        $post->slug = Str::slug($post->title);  //may need to come back in the future and add username
    });
}

}
