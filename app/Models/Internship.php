<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Internship extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'location',
        'category_id',
        'company_name',
        'image',
        'is_active'
    ];

    public $translatable = ['title', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
