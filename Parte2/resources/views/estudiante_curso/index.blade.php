@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inscripciones</h1>
    <a href="{{ route('estudiante_curso.create') }}" class="btn btn-primary mb-3">Nueva Inscripción</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Curso</th>
                <th>Fecha Inscripción</th>
                <th>Calificación</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inscripciones as $insc)
            <tr>
                <td>{{ $insc->id_inscripcion }}</td>
                <td>{{ $insc->estudiante->nombre }} {{ $insc->estudiante->apellido }}</td>
                <td>{{ $insc->curso->nombre_curso }}</td>
                <td>{{ $insc->fecha_inscripcion }}</td>
                <td>{{ $insc->calificacion }}</td>
                <td>{{ $insc->estado }}</td>
                <td>
                    <a href="{{ route('estudiante_curso.edit', $insc->id_inscripcion) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('estudiante_curso.destroy', $insc->id_inscripcion) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
