<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    
    protected $fillable = [
        'food_item_id',
        'user_id',
        'make_suggested_dish',
        'rate_ingredients_used',
        'rate_preparation_time',
        'rate_how_prepare_meal',
        'ingredients_like',
        'ingredients_dislike',
        'preparation_time_suitable',
        'preparation_time_align',
        'instructions_provided',
        'rate_of_sweet_taste',
        'rate_of_sour_taste',
        'rate_of_bitter_taste',
        'rate_of_spicy_taste',
        'other_recommendations',
    ];
    
}
