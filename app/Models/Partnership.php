<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partnership extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'type',
        'duration',
        'services',
        'budget',
        'status',
        'start_date',
        'end_date',
        'description',
        'terms'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
        'services' => 'array',
        'terms' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'active' => 'success',
            'pending' => 'warning',
            'completed' => 'info',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }
}