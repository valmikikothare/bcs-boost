<?php

namespace App\Models;

use App\Models\User;
use App\Models\ForumAnswer;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'forum';
    protected $fillable = [
        'title', 'content','user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
{
    return $this->hasMany(ForumAnswer::class,'forum_id','id');
}
    
    public function forumansers()
    {
        return $this->hasMany(ForumAnswer::class,'forum_id','id');
    }

    public function likedByUser($user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function likes()
{
    return $this->morphMany(Like::class, 'likeable')->where('type', 'like');
}

public function dislikes()
{
    return $this->morphMany(Like::class, 'likeable')->where('type', 'dislike');
}


}
?>