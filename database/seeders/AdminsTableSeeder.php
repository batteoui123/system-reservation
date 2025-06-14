<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'utilisateur_id' => 1, // correspond à admin@ensa.ma
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
