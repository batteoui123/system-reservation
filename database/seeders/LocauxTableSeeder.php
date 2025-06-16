<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocauxTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('locaux')->insert([
            [
                'nom' => 'Salle B20',
                'type' => 'Salle',
                'capacite' => 40,
                'status' => 'libre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'salle de conference',
                'type' => 'Conférence',
                'capacite' => 100,
                'status' => 'libre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Amphi 1',
                'type' => 'Amphi',
                'capacite' => 300,
                'status' => 'libre',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
