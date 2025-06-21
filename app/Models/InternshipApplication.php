<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InternshipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'student_name',
        'student_email',
        'student_phone',
        'nationality',
        'cv_path',
        'cover_letter',
        'status',
        'applied_at'
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(InternshipOffer::class, 'offer_id');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'accepted' => 'success',
            'pending' => 'warning',
            'rejected' => 'danger',
            'interview' => 'info',
            default => 'secondary'
        };
    }
}