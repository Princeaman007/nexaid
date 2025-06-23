<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class PartnershipRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'website',
        'address',
        'description',
        'services_needed',
        'partnership_type',
        'partnership_duration',
        'budget_range',
        'long_term_partnership',
        'collaboration_expectations',
        'status',
        'admin_notes',
        'reviewed_at',
        'reviewed_by',
    ];

    protected $casts = [
        'services_needed' => 'array',
        'long_term_partnership' => 'boolean',
        'budget_range' => 'decimal:2',
        'reviewed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'status' => 'pending',
        'long_term_partnership' => false,
    ];

    /**
     * Available statuses
     */
    public const STATUSES = [
        'pending' => 'Pending',
        'in_review' => 'In Review',
        'approved' => 'Approved',
        'rejected' => 'Rejected',
        'contacted' => 'Contacted',
    ];

    /**
     * Available partnership types
     */
    public const PARTNERSHIP_TYPES = [
        'strategic' => 'Strategic',
        'commercial' => 'Commercial',
        'technological' => 'Technological',
    ];

    /**
     * Available partnership durations
     */
    public const PARTNERSHIP_DURATIONS = [
        'short_term' => 'Short term (< 1 year)',
        'medium_term' => 'Medium term (1-3 years)',
        'long_term' => 'Long term (3+ years)',
    ];

    /**
     * Available services
     */
    public const AVAILABLE_SERVICES = [
        'recruitment_consulting' => 'Recruitment Consulting',
        'intercultural_training' => 'Intercultural Training',
        'tech_tools' => 'Tech Tools',
        'marketing_support' => 'Marketing Support',
        'strategic_guidance' => 'Strategic Guidance',
        'other' => 'Other',
    ];

    /**
     * Get the admin who reviewed this request
     */
    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'in_review' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
            'contacted' => 'primary',
            default => 'secondary',
        };
    }

    /**
     * Get formatted budget
     */
    public function getFormattedBudgetAttribute(): string
    {
        if (!$this->budget_range) {
            return 'Not specified';
        }
        
        return '€' . number_format($this->budget_range, 0, ',', ' ');
    }

    /**
     * Get services as string
     */
    public function getServicesStringAttribute(): string
    {
        if (!$this->services_needed || empty($this->services_needed)) {
            return 'None specified';
        }
        
        $serviceNames = [];
        foreach ($this->services_needed as $serviceKey) {
            $serviceNames[] = self::AVAILABLE_SERVICES[$serviceKey] ?? $serviceKey;
        }
        
        return implode(', ', $serviceNames);
    }

    /**
     * Get partnership type label
     */
    public function getPartnershipTypeLabelAttribute(): string
    {
        return self::PARTNERSHIP_TYPES[$this->partnership_type] ?? $this->partnership_type ?? 'Not specified';
    }

    /**
     * Get partnership duration label
     */
    public function getPartnershipDurationLabelAttribute(): string
    {
        return self::PARTNERSHIP_DURATIONS[$this->partnership_duration] ?? $this->partnership_duration ?? 'Not specified';
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    /**
     * Get company initials for avatar
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return substr($initials, 0, 2);
    }

    /**
     * Get time since submission
     */
    public function getTimeSinceSubmissionAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Check if request is pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if request is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if request is rejected
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check if request has been reviewed
     */
    public function isReviewed(): bool
    {
        return !is_null($this->reviewed_at);
    }

    /**
     * Check if request is urgent (pending for more than 7 days)
     */
    public function isUrgent(): bool
    {
        return $this->isPending() && $this->created_at->diffInDays(now()) > 7;
    }

    /**
     * Check if company has website
     */
    public function hasWebsite(): bool
    {
        return !empty($this->website);
    }

    /**
     * Check if company has phone
     */
    public function hasPhone(): bool
    {
        return !empty($this->phone);
    }

    /**
     * Check if has budget information
     */
    public function hasBudget(): bool
    {
        return !is_null($this->budget_range) && $this->budget_range > 0;
    }

    /**
     * Scope for pending requests
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for approved requests
     */
    public function scopeApproved(Builder $query): Builder
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected requests
     */
    public function scopeRejected(Builder $query): Builder
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope for in review requests
     */
    public function scopeInReview(Builder $query): Builder
    {
        return $query->where('status', 'in_review');
    }

    /**
     * Scope for contacted requests
     */
    public function scopeContacted(Builder $query): Builder
    {
        return $query->where('status', 'contacted');
    }

    /**
     * Scope for recent requests
     */
    public function scopeRecent(Builder $query, int $days = 30): Builder
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope for urgent requests (pending for more than 7 days)
     */
    public function scopeUrgent(Builder $query): Builder
    {
        return $query->pending()->where('created_at', '<=', now()->subDays(7));
    }

    /**
     * Scope for requests with budget
     */
    public function scopeWithBudget(Builder $query): Builder
    {
        return $query->whereNotNull('budget_range')->where('budget_range', '>', 0);
    }

    /**
     * Scope for long-term partnership interests
     */
    public function scopeLongTerm(Builder $query): Builder
    {
        return $query->where('long_term_partnership', true);
    }

    /**
     * Scope for requests by partnership type
     */
    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('partnership_type', $type);
    }

    /**
     * Scope for search by company name or email
     */
    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Scope for requests this month
     */
    public function scopeThisMonth(Builder $query): Builder
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    /**
     * Scope for requests last month
     */
    public function scopeLastMonth(Builder $query): Builder
    {
        $lastMonth = now()->subMonth();
        return $query->whereMonth('created_at', $lastMonth->month)
                    ->whereYear('created_at', $lastMonth->year);
    }

    /**
     * Boot method
     */
    protected static function boot()
    {
        parent::boot();

        // Automatically set status to pending when creating
        static::creating(function ($model) {
            if (empty($model->status)) {
                $model->status = 'pending';
            }
        });
    }

    /**
     * Get route key name for model binding
     */
    public function getRouteKeyName(): string
    {
        return 'id';
    }

    /**
     * Get the table associated with the model.
     */
    public function getTable(): string
    {
        return 'partnership_requests';
    }
}