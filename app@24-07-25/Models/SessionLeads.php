<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionLeads extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slot_id',
        'agenda',
        'description',
        'other_details',
        'status',
    ];

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor to format created_at as MdY
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('M-D-Y');
    }
}
