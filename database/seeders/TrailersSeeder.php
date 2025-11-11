<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TrailersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trailers = [
            [
                'id' => Str::uuid(),
                'modelo' => 'Freightliner Cascadia 2020',
                'numero_serie' => '1FUJGHDV8LLBX7890',
                'placa' => 'TRL-001-MX',
                'estado_trailer' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'modelo' => 'Kenworth T680 2021',
                'numero_serie' => '1XKYDP9X2MJ456789',
                'placa' => 'TRL-002-MX',
                'estado_trailer' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'modelo' => 'Volvo VNL 2019',
                'numero_serie' => '4V4NC9EH5KN123456',
                'placa' => 'TRL-003-MX',
                'estado_trailer' => 'rentado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'modelo' => 'Peterbilt 579 2022',
                'numero_serie' => '1XPBDP9X6ND789012',
                'placa' => 'TRL-004-MX',
                'estado_trailer' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'modelo' => 'International LT 2020',
                'numero_serie' => '2HSFHAPR8LC345678',
                'placa' => 'TRL-005-MX',
                'estado_trailer' => 'mantenimiento',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'modelo' => 'Mack Anthem 2021',
                'numero_serie' => '1M2AN07C9MM901234',
                'placa' => 'TRL-006-MX',
                'estado_trailer' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('trailers')->insert($trailers);
    }
}
