<?php

namespace App\Http\Controllers\Lab3;

use App\Models\EstudianteCurso;
use App\Models\Estudiante;
use App\Models\Cursor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstudianteCursoController extends Controller
{
    public function index()
    {
        $inscripciones = EstudianteCurso::with(['estudiante', 'curso'])->get();
        return view('estudiante_curso.index', compact('inscripciones'));
    }

    public function create()
    {
        $estudiantes = Estudiante::all();
        $cursos = Cursor::all();
        return view('estudiante_curso.create', compact('estudiantes', 'cursos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_estudiante' => 'required|exists:estudiantes,id_estudiante',
            'id_curso' => 'required|exists:cursos,id_curso',
            'fecha_inscripcion' => 'required|date',
            'calificacion' => 'nullable|numeric|min:0|max:100',
            'estado' => 'required|string',
        ]);
        EstudianteCurso::create($validated);
        return redirect()->route('estudiante_curso.index');
    }

    public function edit($id)
    {
        $inscripcion = EstudianteCurso::findOrFail($id);
        $estudiantes = Estudiante::all();
        $cursos = Cursor::all();
        return view('estudiante_curso.edit', compact('inscripcion', 'estudiantes', 'cursos'));
    }

    public function update(Request $request, $id)
    {
        $inscripcion = EstudianteCurso::findOrFail($id);
        $validated = $request->validate([
            'id_estudiante' => 'required|exists:estudiantes,id_estudiante',
            'id_curso' => 'required|exists:cursos,id_curso',
            'fecha_inscripcion' => 'required|date',
            'calificacion' => 'nullable|numeric|min:0|max:100',
            'estado' => 'required|string',
        ]);
        $inscripcion->update($validated);
        return redirect()->route('estudiante_curso.index');
    }

    public function destroy($id)
    {
        $inscripcion = EstudianteCurso::findOrFail($id);
        $inscripcion->delete();
        return redirect()->route('estudiante_curso.index');
    }
}
