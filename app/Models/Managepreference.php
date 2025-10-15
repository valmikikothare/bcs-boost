<?php

namespace App\Models;

use App\Models\ArchivePreference;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Managepreference extends Model
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'user_id',
        'diet_id',
        'taste_id',
        'kitchen_id',
        'preparation_id',
        'like_ingredients',
        'dislike_ingredients',
        'feedback_id'
    ];

    public function archive_preference(){
        return $this->hasMany(ArchivePreference::class,'manage_preference_id','id');
    }

}
