<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'published_at',
        'is_active'
    ];

    // Champs traduisibles
    public $translatable = ['title', 'content'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];
}
