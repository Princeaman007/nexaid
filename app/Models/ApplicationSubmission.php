<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationSubmission extends Model
{
    protected $fillable = [
        'internship_id',
        'name',
        'email',
        'phone',
        'cv_path',
        'cover_letter',
        'education',
        'experience',
        'linkedin',
        'status',
        'applied_at',
    ];

    protected $casts = [
        'applied_at' => 'datetime',
    ];

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }
}