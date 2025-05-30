<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateCustomTypesAndView extends Migration
{
    public function up()
    {
        DB::statement(<<<SQL
            CREATE OR REPLACE VIEW vista_estudiantes_cursos AS
            SELECT e.id_estudiante, e.nombre, e.apellido, e.email, e.fecha_nacimiento, e.direccion, e.telefono,
                STRING_AGG(c.nombre_curso, ', ') AS cursos
            FROM estudiantes e
            LEFT JOIN estudiante_curso ec ON e.id_estudiante = ec.id_estudiante
            LEFT JOIN cursos c ON ec.id_curso = c.id_curso
            GROUP BY e.id_estudiante, e.nombre, e.apellido, e.email, e.fecha_nacimiento, e.direccion, e.telefono
            SQL
        );
    }

    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS vista_estudiantes_cursos");
    }
}
