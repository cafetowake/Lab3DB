<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstudianteCursoSeeder extends Seeder
{
    public function run()
    {
        for ($est = 1; $est <= 30; $est++) {
            $cursos = array_rand(range(1, 10), rand(2, 3));
            if (!is_array($cursos)) $cursos = [$cursos];
            foreach ($cursos as $curso) {
                DB::table('estudiante_curso')->insert([
                    'id_estudiante' => $est,
                    'id_curso' => $curso + 1,
                    'fecha_inscripcion' => now()->subDays(rand(1, 30)),
                    'calificacion' => rand(60, 100) / 10,
                    'estado' => 'activa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
