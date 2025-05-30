<?php

namespace App\Http\Controllers\Lab3;

use App\Models\Estudiante;
use App\Models\Cursor;
use App\Models\EstudianteCurso;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = \DB::table('vista_estudiantes_cursos')->get();
        return view('estudiantes.index', compact('estudiantes'));
    }

    public function create()
    {
        $cursos = Cursor::all();
        return view('estudiantes.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'cursos' => 'required|array|min:1',
            'cursos.*' => 'exists:cursos,id_curso',
        ]);

        $estudiante = Estudiante::create([
            'nombre' => $validated['nombre'],
            'apellido' => $validated['apellido'],
            'email' => $validated['email'],
            'fecha_nacimiento' => $validated['fecha_nacimiento'],
            'direccion' => $validated['direccion'],
            'telefono' => $validated['telefono'],
        ]);

        $cursosPivot = [];
        foreach ($validated['cursos'] as $cursoId) {
            $cursosPivot[$cursoId] = [
                'fecha_inscripcion' => now(),
                'calificacion' => null,
                'estado' => 'activa',
            ];
        }
        $estudiante->cursos()->attach($cursosPivot);

        return redirect()->route('estudiantes.index');
    }

    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $cursos = Cursor::all();
        $cursosSeleccionados = $estudiante->cursos->pluck('id_curso')->toArray();
        return view('estudiantes.edit', compact('estudiante', 'cursos', 'cursosSeleccionados'));
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:estudiantes,email,' . $id . ',id_estudiante',
            'fecha_nacimiento' => 'required|date',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'cursos' => 'required|array',
            'cursos.*' => 'exists:cursos,id_curso',
        ]);
        $estudiante->update($validated);
        $estudiante->cursos()->sync($validated['cursos']);
        return redirect()->route('estudiantes.index');
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $estudiante->cursos()->detach();
        $estudiante->delete();
        return redirect()->route('estudiantes.index');
    }
}
