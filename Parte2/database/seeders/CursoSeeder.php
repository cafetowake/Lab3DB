<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    public function run()
    {
        $tipos = ['obligatorio', 'electivo', 'taller', 'seminario'];
        for ($i = 1; $i <= 10; $i++) {
            DB::table('cursos')->insert([
                'nombre_curso' => 'Curso ' . $i,
                'descripcion' => 'Descripción del curso ' . $i,
                'creditos' => rand(1, 10),
                'profesor' => 'Profesor ' . $i,
                'tipo' => $tipos[array_rand($tipos)],
                'cupo_maximo' => rand(10, 50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
