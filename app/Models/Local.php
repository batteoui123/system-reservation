<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locaux';
    protected $fillable = ['nom', 'type', 'capacite', 'status'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
