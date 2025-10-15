<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ForumAnswer extends Model
{
    protected $table = 'forum_answer';
    protected $fillable = [
        'user_id', 'forum_id','answer'
    ];


    public function answeruser()
    {
        return $this->belongsTo(User::class,'user_id','id');
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