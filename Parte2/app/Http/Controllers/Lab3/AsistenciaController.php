<?php

namespace App\Http\Controllers\Lab3;

use App\Models\Asistencia;
use App\Models\EstudianteCurso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::with('inscripcion')->get();
        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $inscripciones = EstudianteCurso::all();
        return view('asistencias.create', compact('inscripciones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_inscripcion' => 'required|exists:estudiante_curso,id_inscripcion',
            'fecha' => 'required|date',
            'presente' => 'required|boolean',
            'observaciones' => 'nullable|string',
        ]);
        Asistencia::create($validated);
        return redirect()->route('asistencias.index');
    }

    public function edit($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $inscripciones = EstudianteCurso::all();
        return view('asistencias.edit', compact('asistencia', 'inscripciones'));
    }

    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $validated = $request->validate([
            'id_inscripcion' => 'required|exists:estudiante_curso,id_inscripcion',
            'fecha' => 'required|date',
            'presente' => 'required|boolean',
            'observaciones' => 'nullable|string',
        ]);
        $asistencia->update($validated);
        return redirect()->route('asistencias.index');
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::findOrFail($id);
        $asistencia->delete();
        return redirect()->route('asistencias.index');
    }
}
