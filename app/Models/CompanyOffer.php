<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyOffer extends Model
{
    protected $fillable = [
        'nom', 
        'email', 
        'poste', 
        'duree', 
        'competences', 
        'remuneration', 
        'message', 
        'statut'
    ];
}
