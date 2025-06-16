<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $table = 'etudiants';
    protected $fillable = ['utilisateur_id', 'code'];

    public function utilisateur()
    {
        return $this->belongsTo(User::class,'utilisateur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
