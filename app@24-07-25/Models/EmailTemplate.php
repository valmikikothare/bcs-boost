<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class EmailTemplate extends Model
{
    protected $table = 'email_template';
    protected $fillable = ['alias_name','template'];
    
}
