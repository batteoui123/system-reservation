<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ReleaseLocaux extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = now();

        $reservations = \App\Models\Reservation::where('statut', 'accepte')
            ->whereDate('date', '<=', $now->toDateString())
            ->whereTime('heure_fin', '<=', $now->format('H:i:s'))
            ->get();

        foreach ($reservations as $reservation) {
            $local = $reservation->local;
            $local->status = 'libre';
            $local->save();

            $reservation->statut = 'termine';
            $reservation->save();
        }

        $this->info('Locaux libérés avec succès.');
    }

}
