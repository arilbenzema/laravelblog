<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'author',
        'author_info',
        'category',
        'slug',
        'user_id',

    ];
    public function comments()
{
    return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
