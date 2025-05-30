@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estudiantes</h1>
    <a href="{{ route('estudiantes.create') }}" class="btn btn-primary mb-3">Nuevo Estudiante</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Fecha Nacimiento</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Cursos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($estudiantes as $est)
            <tr>
                <td>{{ $est->id_estudiante }}</td>
                <td>{{ $est->nombre }}</td>
                <td>{{ $est->apellido }}</td>
                <td>{{ $est->email }}</td>
                <td>{{ $est->fecha_nacimiento }}</td>
                <td>{{ $est->direccion }}</td>
                <td>{{ $est->telefono }}</td>
                <td>{{ $est->cursos }}</td>
                <td>
                    <a href="{{ route('estudiantes.edit', $est->id_estudiante) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('estudiantes.destroy', $est->id_estudiante) }}" method="POST" style="display:inline-block">
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
