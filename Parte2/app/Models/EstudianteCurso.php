<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cursor;

class EstudianteCurso extends Model {
    use HasFactory;
    protected $table = 'estudiante_curso';
    protected $primaryKey = 'id_inscripcion';
    protected $fillable = ['id_estudiante', 'id_curso', 'fecha_inscripcion', 'calificacion', 'estado'];

    public function estudiante() {
        return $this->belongsTo(Estudiante::class, 'id_estudiante');
    }

    public function curso() {
        return $this->belongsTo(Cursor::class, 'id_curso');
    }

    public function asistencias() {
        return $this->hasMany(Asistencia::class, 'id_inscripcion');
    }
}