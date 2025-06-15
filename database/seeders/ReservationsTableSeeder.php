<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservations')->insert([
            'date' => now()->toDateString(),
            'heure_debut' => Carbon::createFromTime(10, 0, 0)->toTimeString(),
            'heure_fin'   => Carbon::createFromTime(11, 0, 0)->toTimeString(),
            'statut' => 'en attente',
            'etudiant_id' => 1,
            'local_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
