<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtudiantsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('etudiants')->insert([
            'utilisateur_id' => 2, // correspond à etudiant@ensa.ma
            'code' => 'S130205684',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
