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
                'nom' => 'Salle 101',
                'type' => 'Salle',
                'capacite' => 30,
                'status' => 'libre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Conférence A',
                'type' => 'Conférence',
                'capacite' => 100,
                'status' => 'libre',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'Amphi 1',
                'type' => 'Amphi',
                'capacite' => 200,
                'status' => 'libre',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
