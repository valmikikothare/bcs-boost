<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CancellationRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cancellation_requests';

    protected $fillable = [
        'slot_id',
        'user_id',
        'cancellation_status',
    ];

    /**
     * Relationships
     */

    // Each request belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Each request belongs to a slot
    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    
}
