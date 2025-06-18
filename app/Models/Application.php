<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    protected $fillable = [
        'internship_id',
        'name',
        'email',
        'phone',
        'linkedin',
        'education',
        'experience',
        'cover_letter',
        'cv_path',
        'agree_terms',
        'status',
        'interview_date',
        'interview_location',
        'response_message',
        'responded_at'
    ];

    protected $casts = [
        'agree_terms' => 'boolean',
        'interview_date' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function internship(): BelongsTo
    {
        return $this->belongsTo(Internship::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'En attente',
            'accepted' => 'Acceptée',
            'rejected' => 'Refusée',
            'interview_scheduled' => 'Entretien programmé',
            default => 'Inconnu'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'accepted' => 'success',
            'rejected' => 'danger',
            'interview_scheduled' => 'info',
            default => 'gray'
        };
    }
}