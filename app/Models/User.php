<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Laravel par défaut utilise la table 'users', ici on la force à 'utilisateurs'
    protected $table = 'utilisateurs';

    protected $fillable = [
        'nom',
        'email',
        'mot_de_passe',
        'role',
    ];

    protected $hidden = [
        'mot_de_passe',
    ];

    /**
     * Indique à Laravel quel champ est utilisé comme mot de passe
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    // Relations (si tu les utilises)
    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function etudiant()
    {
        return $this->hasOne(Etudiant::class);
    }
}
