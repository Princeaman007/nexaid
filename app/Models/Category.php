<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasTranslations;
    
    public $translatable = ['name'];
    
    protected $fillable = ['name', 'slug'];

    // Le cast array n'est pas nécessaire quand vous utilisez HasTranslations
    // car le trait s'occupe déjà de ça
    
    public function internships()
    {
        return $this->hasMany(Internship::class);
    }
}