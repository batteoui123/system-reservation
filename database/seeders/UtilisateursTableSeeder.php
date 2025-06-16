<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UtilisateursTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('utilisateurs')->insert([
            [
                'nom' => 'Admin',
                'email' => 'admin@ensa.ma',
                'mot_de_passe' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'mohamed ouahabi',
                'email' => 'mohamed@etu.uae.ac.ma',
                'mot_de_passe' => Hash::make('password'),
                'role' => 'etudiant',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom' => 'youssef ouahabi',
                'email' => 'youssef@etu.uae.ac.ma',
                'mot_de_passe' => Hash::make('password'),
                'role' => 'etudiant',
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}
