<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cursor extends Model {
    protected $table = 'cursos';
    use HasFactory;
    protected $primaryKey = 'id_curso';
    protected $fillable = ['nombre_curso', 'descripcion', 'creditos', 'profesor', 'tipo', 'cupo_maximo'];

    public function estudiantes() {
        return $this->belongsToMany(Estudiante::class, 'estudiante_curso', 'id_curso', 'id_estudiante')
                    ->withPivot('id_inscripcion', 'fecha_inscripcion', 'calificacion', 'estado')
                    ->withTimestamps();
    }
}