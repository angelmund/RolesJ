<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Categoria::insert([
            ['nombre' => 'Libre'],
            ['nombre' => 'Sub 15'],
            ['nombre' => 'Sub 17'],
            ['nombre' => 'Sub 20'],
            ['nombre' => 'Sub 23'],
            ['nombre' => 'Femenino'],
            ['nombre' => 'Mixto'],

        ]);
    }
}
