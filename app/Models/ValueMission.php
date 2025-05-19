<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class ValueMission extends Model
{
    use HasTranslations;

    protected $fillable = ['title', 'description', 'is_active'];

    public $translatable = ['title', 'description'];
}

