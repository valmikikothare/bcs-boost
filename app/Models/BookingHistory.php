<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingHistory extends Model
{
    use HasFactory;

    // Define the table name if it's different from the default
    protected $table = 'booking_history';

    // Allow mass assignment for these fields
    protected $fillable = [
        'slot_id',
        'user_id',
        'status',
    ];

    // Casts for date fields
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Define relationships if needed
     */

    // Example: Belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Example: Belongs to a slot
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }



    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('M-D-Y');
    }

}
