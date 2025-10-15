<?php

namespace App\Models;

use App\Models\User;
use App\Models\Fooditem;
use Illuminate\Database\Eloquent\Model;

class SuggestionDish extends Model
{
    protected $table = 'suggestion_dish';
    
    protected $fillable = [
        'user_id',
        'suggestion_dish_id',
        'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fooditems()
    {
        return $this->belongsTo(Fooditem::class,'suggestion_dish_id','id');
    }
    
}
