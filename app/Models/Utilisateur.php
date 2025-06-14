<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    protected $fillable = ['nom', 'email', 'mot_de_passe', 'role'];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function etudiant()
    {
        return $this->hasOne(Etudiant::class);
    }
}
