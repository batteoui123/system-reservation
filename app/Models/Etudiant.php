<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['utilisateur_id', 'code'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
