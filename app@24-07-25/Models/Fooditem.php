<?php

namespace App\Models;

use App\Models\Managekitchen;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Fooditem extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'short_desc',
        'ingredients',
        'prepare',
        'portions',
        'time',
        'type_meal',
        'type_diet',
        'taste',
        'image',
        'kitchen_region',
        'preparation',
        'sidedish',
        'vegetable',
        'meat',
    ];

    public function Managekitchen()
    {
        return $this->hasOne(Managekitchen::class,'id','kitchen_region');
    }

    public function Managetaste()
    {
        return $this->hasOne(Managetaste::class,'id','taste');
    }

    public function Managediet()
    {
        return $this->hasOne(Managediet::class,'id','type_diet');
    }

    public function Managepreparation()
    {
        return $this->hasOne(Managepreparation::class,'id','preparation');
    }
    public function Managesidedish()
    {
        return $this->hasOne(Sidedish::class,'id','sidedish');
    }
    public function Managevegetables()
    {
        return $this->hasOne(Managevegetable::class,'id','vegetable');
    }
    public function Managemeat()
    {
        return $this->hasOne(Managemeat::class,'id','meat');
    }



}
