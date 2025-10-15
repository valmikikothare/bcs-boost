<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SessionEmailJob extends Model
{
    use SoftDeletes;

    protected $table = 'session_email_jobs';

    protected $fillable = [
        'email',
        'type',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
