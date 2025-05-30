<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateEstudiantesAndRelatedTables extends Migration
{
    public function up()
    {
        DB::statement("DROP TYPE IF EXISTS estado_inscripcion CASCADE");
        DB::statement("DROP TYPE IF EXISTS tipo_curso CASCADE");
        DB::statement("CREATE TYPE estado_inscripcion AS ENUM ('activa', 'cancelada', 'completada')");
        DB::statement("CREATE TYPE tipo_curso AS ENUM ('obligatorio', 'electivo', 'taller', 'seminario')");

        Schema::create('estudiantes', function (Blueprint $table) {
            $table->bigIncrements('id_estudiante');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('email', 100)->unique();
            $table->date('fecha_nacimiento');
            $table->text('direccion')->nullable();
            $table->string('telefono', 20)->nullable();
            $table->timestamps();
        });

        Schema::create('cursos', function (Blueprint $table) {
            $table->bigIncrements('id_curso');
            $table->string('nombre_curso', 100)->unique();
            $table->text('descripcion')->nullable();
            $table->smallInteger('creditos');
            $table->string('profesor', 100);
            $table->enum('tipo', ['obligatorio', 'electivo', 'taller', 'seminario'])->default('obligatorio');
            $table->smallInteger('cupo_maximo');
            $table->timestamps();
        });

        Schema::create('estudiante_curso', function (Blueprint $table) {
            $table->bigIncrements('id_inscripcion');
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_curso');
            $table->date('fecha_inscripcion')->default(DB::raw('CURRENT_DATE'));
            $table->decimal('calificacion', 3, 1)->nullable();
            $table->enum('estado', ['activa', 'cancelada', 'completada'])->default('activa');
            $table->timestamps();
            $table->unique(['id_estudiante', 'id_curso']);
            $table->foreign('id_estudiante')->references('id_estudiante')->on('estudiantes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_curso')->references('id_curso')->on('cursos')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('asistencia', function (Blueprint $table) {
            $table->bigIncrements('id_asistencia');
            $table->unsignedBigInteger('id_inscripcion');
            $table->date('fecha');
            $table->boolean('presente')->default(false);
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->unique(['id_inscripcion', 'fecha']);
            $table->foreign('id_inscripcion')->references('id_inscripcion')->on('estudiante_curso')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('asistencia');
        Schema::dropIfExists('estudiante_curso');
        Schema::dropIfExists('cursos');
        Schema::dropIfExists('estudiantes');
        DB::statement("DROP TYPE IF EXISTS estado_inscripcion");
        DB::statement("DROP TYPE IF EXISTS tipo_curso");
    }
}
