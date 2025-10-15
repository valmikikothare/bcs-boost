<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Carbon\Carbon;
use App\Models\BookingHistory;

class Slot extends Model
{
    use HasFactory, SoftDeletes; 

    protected $fillable = ['name', 'date', 'start_time', 'end_time', 'no_of_attendees', 'status'];


    public function leads()
{
    return $this->hasMany(SessionLeads::class);
}

public function getStatusTextAttribute()
{
    return $this->status == 1 ? 'Approved' : 'Pending';
}

public function sessionLeads()
{
    return $this->hasOne(SessionLeads::class, 'slot_id');
}



public function bookinghistory()
{
    return $this->hasMany(BookingHistory::class, 'slot_id');
}

public function booking_history()
{
    return $this->hasOne(BookingHistory::class, 'slot_id')->where('user_id',Auth::user()->id);
}



public function getDateAttribute($value)
{
    return Carbon::createFromFormat('Y-m-d', $value)->format('m-d-Y');
}



public function getStartTimeAttribute($value)
{
    return Carbon::parse($value)->format('h:i A');
}

// Accessor to format 'end_time' as h:i A
public function getEndTimeAttribute($value)
{
    return Carbon::parse($value)->format('h:i A');
}

}