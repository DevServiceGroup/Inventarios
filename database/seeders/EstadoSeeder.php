<?php

namespace Database\Seeders;

use App\Models\Estados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Estados::create(['estado' => 'Pendiente por procesar']);
        Estados::create(['estado' => 'Procesada']);
        Estados::create(['estado' => 'Anulada']);
    }
}
