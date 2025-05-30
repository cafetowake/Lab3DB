<?php

namespace App\Http\Controllers\Lab3;

use App\Models\Cursor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Cursor::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'creditos' => 'required|integer|min:1',
            'profesor' => 'required|string',
            'tipo' => 'required|string',
            'cupo_maximo' => 'required|integer|min:1',
        ]);
        Cursor::create($validated);
        return redirect()->route('cursos.index');
    }

    public function edit($id)
    {
        $curso = Cursor::findOrFail($id);
        return view('cursos.edit', compact('curso'));
    }

    public function update(Request $request, $id)
    {
        $curso = Cursor::findOrFail($id);
        $validated = $request->validate([
            'nombre_curso' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'creditos' => 'required|integer|min:1',
            'profesor' => 'required|string',
            'tipo' => 'required|string',
            'cupo_maximo' => 'required|integer|min:1',
        ]);
        $curso->update($validated);
        return redirect()->route('cursos.index');
    }

    public function destroy($id)
    {
        $curso = Cursor::findOrFail($id);
        $curso->delete();
        return redirect()->route('cursos.index');
    }
}
