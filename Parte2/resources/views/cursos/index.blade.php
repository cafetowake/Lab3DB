@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cursos</h1>
    <a href="{{ route('cursos.create') }}" class="btn btn-primary mb-3">Nuevo Curso</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Créditos</th>
                <th>Profesor</th>
                <th>Tipo</th>
                <th>Cupo Máximo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cursos as $curso)
            <tr>
                <td>{{ $curso->id_curso }}</td>
                <td>{{ $curso->nombre_curso }}</td>
                <td>{{ $curso->descripcion }}</td>
                <td>{{ $curso->creditos }}</td>
                <td>{{ $curso->profesor }}</td>
                <td>{{ $curso->tipo }}</td>
                <td>{{ $curso->cupo_maximo }}</td>
                <td>
                    <a href="{{ route('cursos.edit', $curso->id_curso) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('cursos.destroy', $curso->id_curso) }}" method="POST" style="display:inline-block">
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
