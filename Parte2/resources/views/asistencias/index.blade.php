@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Asistencias</h1>
    <a href="{{ route('asistencias.create') }}" class="btn btn-primary mb-3">Nueva Asistencia</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Inscripción</th>
                <th>Fecha</th>
                <th>Presente</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asistencias as $asistencia)
            <tr>
                <td>{{ $asistencia->id_asistencia }}</td>
                <td>{{ $asistencia->inscripcion->estudiante->nombre }} {{ $asistencia->inscripcion->estudiante->apellido }} - {{ $asistencia->inscripcion->curso->nombre_curso }}</td>
                <td>{{ $asistencia->fecha }}</td>
                <td>{{ $asistencia->presente ? 'Sí' : 'No' }}</td>
                <td>{{ $asistencia->observaciones }}</td>
                <td>
                    <a href="{{ route('asistencias.edit', $asistencia->id_asistencia) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('asistencias.destroy', $asistencia->id_asistencia) }}" method="POST" style="display:inline-block">
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
