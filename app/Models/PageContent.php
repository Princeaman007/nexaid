<?php

// app/Models/PageContent.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = [
        'page_type',
        'section_key',
        'title',
        'subtitle',
        'content',
        'meta_data',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'meta_data' => 'array',
        'is_active' => 'boolean'
    ];

    // Types de pages
    const PAGE_TYPES = [
        'hiring' => 'Recrutement',
        'partnership' => 'Partenariat', 
        'offer_sender' => 'Publication d\'offres'
    ];

    // Sections disponibles
    const SECTIONS = [
        'hero' => 'Section Hero',
        'benefits' => 'Avantages',
        'process' => 'Processus',
        'testimonials' => 'Témoignages',
        'stats' => 'Statistiques',
        'cta' => 'Call to Action'
    ];

    public function scopeForPage($query, $pageType)
    {
        return $query->where('page_type', $pageType);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}

// app/Models/Testimonial.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'company_name',
        'company_logo',
        'contact_name',
        'contact_position',
        'testimonial_text',
        'rating',
        'company_size',
        'industry',
        'tags',
        'metrics',
        'is_featured',
        'is_active'
    ];

    protected $casts = [
        'tags' => 'array',
        'metrics' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'decimal:1'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}

// app/Models/SiteSettings.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'description'
    ];

    protected $casts = [
        'value' => 'json'
    ];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $type = 'text', $group = 'general')
    {
        return self::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group
            ]
        );
    }
}

// app/Models/ProcessStep.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = [
        'page_type',
        'step_number',
        'title',
        'description',
        'icon',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function scopeForPage($query, $pageType)
    {
        return $query->where('page_type', $pageType);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}