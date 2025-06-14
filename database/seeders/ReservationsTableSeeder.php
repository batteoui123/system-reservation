<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservations')->insert([
            'date' => now()->toDateString(),
            'creneau' => '10h-11h',
            'statut' => 'en attente',
            'etudiant_id' => 1,
            'local_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
