<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivePreference extends Model
{
    use HasFactory;
    protected $table = 'archive_preference';
    protected $fillable = [
        'manage_preference_id',
        'diet',
        'taste',
        'kitchen',
        'preparation',
        'like_ingredients',
        'dislike_ingredients',
        'clarity_of_instructions',
        'fooditem_id',
        'feedback_id'
    ];
}

?>