<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'author',
        'author_info',
        'image',
        'category',
        'slug',

    ];
    public function comments()
{
    return $this->hasMany(\App\Models\Comment::class)->latest();
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
