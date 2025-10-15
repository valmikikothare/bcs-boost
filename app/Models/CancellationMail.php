<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancellationMail extends Model
{
    use HasFactory, SoftDeletes;

    // Explicitly define the table (optional since Laravel can pluralize correctly)
    protected $table = 'cancellation_mails';

    // Fillable fields
    protected $fillable = [
        'email',
        'mail_template',
        'role',
        'subject',
        'email_send_status',
    ];

    // Casts (if you want role as integer always)
    protected $casts = [
        'role' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A cancellation mail may be linked to a BookingHistory
     */
    public function bookingHistory()
    {
        return $this->belongsTo(BookingHistory::class);
    }

    /**
     * A cancellation mail may be linked to a SessionLead
     */
    public function sessionLead()
    {
        return $this->belongsTo(SessionLeads::class);
    }
}
