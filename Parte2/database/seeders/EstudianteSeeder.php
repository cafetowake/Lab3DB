<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudianteSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            DB::table('estudiantes')->insert([
                'nombre' => 'Nombre' . $i,
                'apellido' => 'Apellido' . $i,
                'email' => 'estudiante' . $i . '@mail.com',
                'fecha_nacimiento' => now()->subYears(18 + $i)->format('Y-m-d'),
                'direccion' => 'Dirección ' . $i,
                'telefono' => '555000' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
