<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estudiante extends Model {
    use HasFactory;
    protected $primaryKey = 'id_estudiante';
    protected $fillable = ['nombre', 'apellido', 'email', 'fecha_nacimiento', 'direccion', 'telefono'];

    public function cursos() {
        return $this->belongsToMany(\App\Models\Cursor::class, 'estudiante_curso', 'id_estudiante', 'id_curso')
                    ->withPivot('id_inscripcion', 'fecha_inscripcion', 'calificacion', 'estado')
                    ->withTimestamps();
    }
}