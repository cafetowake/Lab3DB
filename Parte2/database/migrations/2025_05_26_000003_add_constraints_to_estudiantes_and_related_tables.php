<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddConstraintsToEstudiantesAndRelatedTables extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE estudiantes ADD CONSTRAINT chk_email CHECK (email ~* '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\\.[A-Za-z]+$')");
        DB::statement("ALTER TABLE estudiantes ADD CONSTRAINT chk_fecha_nacimiento CHECK (fecha_nacimiento <= CURRENT_DATE - INTERVAL '15 years')");
        DB::statement("ALTER TABLE estudiantes ADD CONSTRAINT chk_telefono CHECK (telefono ~ '^[0-9]+$')");
        DB::statement("ALTER TABLE cursos ADD CONSTRAINT chk_creditos CHECK (creditos > 0 AND creditos <= 10)");
        DB::statement("ALTER TABLE estudiante_curso ADD CONSTRAINT chk_calificacion CHECK (calificacion BETWEEN 0 AND 10)");
        DB::statement("ALTER TABLE estudiante_curso ADD CONSTRAINT chk_fecha_inscripcion CHECK (fecha_inscripcion <= CURRENT_DATE + INTERVAL '7 days')");
        DB::statement("ALTER TABLE asistencia ADD CONSTRAINT chk_fecha CHECK (fecha <= CURRENT_DATE)");
    }

    public function down()
    {
        DB::statement("ALTER TABLE estudiantes DROP CONSTRAINT IF EXISTS chk_email");
        DB::statement("ALTER TABLE estudiantes DROP CONSTRAINT IF EXISTS chk_fecha_nacimiento");
        DB::statement("ALTER TABLE estudiantes DROP CONSTRAINT IF EXISTS chk_telefono");
        DB::statement("ALTER TABLE cursos DROP CONSTRAINT IF EXISTS chk_creditos");
        DB::statement("ALTER TABLE estudiante_curso DROP CONSTRAINT IF EXISTS chk_calificacion");
        DB::statement("ALTER TABLE estudiante_curso DROP CONSTRAINT IF EXISTS chk_fecha_inscripcion");
        DB::statement("ALTER TABLE asistencia DROP CONSTRAINT IF EXISTS chk_fecha");
    }
}
