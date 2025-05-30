<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model {
    protected $table = 'asistencia';
    use HasFactory;
    protected $primaryKey = 'id_asistencia';
    protected $fillable = ['id_inscripcion', 'fecha', 'presente', 'observaciones'];

    public function inscripcion() {
        return $this->belongsTo(EstudianteCurso::class, 'id_inscripcion');
    }
}