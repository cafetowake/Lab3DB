@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Estudiante</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('estudiantes.update', $estudiante->id_estudiante) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $estudiante->nombre) }}" required>
        </div>
        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $estudiante->apellido) }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $estudiante->email) }}" required>
        </div>
        <div class="mb-3">
            <label>Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $estudiante->fecha_nacimiento) }}" required>
        </div>
        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $estudiante->direccion) }}" required>
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $estudiante->telefono) }}" required>
        </div>
        <div class="mb-3">
            <label>Cursos</label>
            <div class="form-check">
                @foreach($cursos as $curso)
                    <div>
                        <input class="form-check-input" type="checkbox" name="cursos[]" value="{{ $curso->id_curso }}" id="curso{{ $curso->id_curso }}" {{ (is_array(old('cursos', $cursosSeleccionados)) && in_array($curso->id_curso, old('cursos', $cursosSeleccionados))) ? 'checked' : '' }}>
                        <label class="form-check-label" for="curso{{ $curso->id_curso }}">{{ $curso->nombre_curso }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
