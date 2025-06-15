<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'date' => now()->toDateString(),
                'heure_debut' => Carbon::createFromTime(9, 0, 0)->toTimeString(),
                'heure_fin'   => Carbon::createFromTime(9, 10, 0)->toTimeString(),
                'statut' => 'en attente',
                'etudiant_id' => 1,
                'local_id' => 1,
            ],
            [
                'date' => now()->toDateString(),
                'heure_debut' => Carbon::createFromTime(10, 0, 0)->toTimeString(),
                'heure_fin'   => Carbon::createFromTime(11, 0, 0)->toTimeString(),
                'statut' => 'en attente',
                'etudiant_id' => 1,
                'local_id' => 2,
            ],
            [
                'date' => now()->addDay()->toDateString(), // demain
                'heure_debut' => Carbon::createFromTime(11, 0, 0)->toTimeString(),
                'heure_fin'   => Carbon::createFromTime(12, 0, 0)->toTimeString(),
                'statut' => 'en attente',
                'etudiant_id' => 1,
                'local_id' => 3,
            ],
            [
                'date' => now()->toDateString(),
                'heure_debut' => Carbon::createFromTime(13, 0, 0)->toTimeString(),
                'heure_fin'   => Carbon::createFromTime(14, 0, 0)->toTimeString(),
                'statut' => 'en attente',
                'etudiant_id' => 1,
                'local_id' => 1,
            ],
            [
                'date' => now()->toDateString(),
                'heure_debut' => Carbon::createFromTime(15, 0, 0)->toTimeString(),
                'heure_fin'   => Carbon::createFromTime(16, 0, 0)->toTimeString(),
                'statut' => 'en attente',
                'etudiant_id' => 1,
                'local_id' => 2,
            ],
        ];

        foreach ($data as $item) {
            DB::table('reservations')->insert(array_merge($item, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

}
