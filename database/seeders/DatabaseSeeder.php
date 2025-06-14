<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UtilisateursTableSeeder::class,
            AdminsTableSeeder::class,
            EtudiantsTableSeeder::class,
            LocauxTableSeeder::class,
            ReservationsTableSeeder::class,
        ]);
    }

}
