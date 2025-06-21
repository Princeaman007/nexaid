<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class InternshipOffer extends Model
{
    use HasFactory;

    // Forcer le nom de table au cas où
    protected $table = 'internship_offers';

    protected $fillable = [
        'company_id',
        'title',
        'description',
        'location',
        'salary_amount',
        'start_date',
        'end_date',
        'remote_possible',
        'required_skills',
        'status',
        'published_at'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'published_at' => 'datetime',
        'remote_possible' => 'boolean',
        'required_skills' => 'array',
        'salary_amount' => 'decimal:2',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(InternshipApplication::class, 'offer_id');
    }

    public function getDurationAttribute(): string
    {
        if (!$this->start_date || !$this->end_date) {
            return 'Non définie';
        }
        
        $months = $this->start_date->diffInMonths($this->end_date);
        return $months . ' mois';
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'published' && 
               $this->published_at && 
               $this->published_at->isPast();
    }
}
