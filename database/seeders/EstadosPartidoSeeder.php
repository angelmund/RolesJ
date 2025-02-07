<?php

namespace Database\Seeders;

use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadosPartidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\EstadosPartido::insert([
            ['estado' => 'Pendiente'],
            ['estado' => 'Jugado'],
            ['estado' => 'Cancelado'],
            ['estado' => 'Pospuesto'],
        ]);
    }
}
