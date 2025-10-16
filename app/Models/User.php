<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'laboratory_name',
        'email_verification_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'integer',
        'verified_status' => 'integer',
    ];

    /**
     * Interact with the user's first name.
     *
     * @param  string  $value
     */
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ['user', 'admin'][$value],
        );
    }

    public function isAdmin()
    {
        return $this->role === 1;
    }

    public function sessionLeads()
    {
        return $this->hasMany(SessionLeads::class, 'user_id');
    }

    // If one user can have many bookings
    public function bookingHistory()
    {
        return $this->hasMany(BookingHistory::class, 'user_id');
    }

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new CustomResetPasswordNotification($token));
    // }

}
