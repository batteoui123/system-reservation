<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;

class TerminerReservations extends Command
{
    protected $signature = 'reservations:terminer';
    protected $description = 'Marquer automatiquement les réservations passées comme terminées';

    public function handle()
    {
        $now = Carbon::now();

        $reservations = Reservation::whereIn('statut', ['accepte', 'refuse', 'termine','en attente'])
            ->where(function ($query) use ($now) {
                $query->where('date', '<', $now->toDateString())
                    ->orWhere(function ($q) use ($now) {
                        $q->where('date', $now->toDateString())
                            ->where('heure_fin', '<', $now->format('H:i:s'));
                    });
            })
            ->get();

        foreach ($reservations as $res) {
            $res->statut = 'termine';
            $res->save();
        }

        $this->info("Réservations terminées mises à jour avec succès.");
    }
}
