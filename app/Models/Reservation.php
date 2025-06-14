<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'date', 'creneau', 'statut',
        'motif_refus', 'message_annulation',
        'etudiant_id', 'local_id'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function local()
    {
        return $this->belongsTo(Local::class);
    }
}
