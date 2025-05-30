@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Estudiante</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('estudiantes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>
        <div class="mb-3">
            <label>Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>
        <div class="mb-3">
            <label>Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
        </div>
        <div class="mb-3">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}" required>
        </div>
        <div class="mb-3">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}" required>
        </div>
        <div class="mb-3">
            <label>Cursos</label>
            <div class="form-check">
                @foreach($cursos as $curso)
                    <div>
                        <input class="form-check-input" type="checkbox" name="cursos[]" value="{{ $curso->id_curso }}" id="curso{{ $curso->id_curso }}" {{ (is_array(old('cursos')) && in_array($curso->id_curso, old('cursos', []))) ? 'checked' : '' }}>
                        <label class="form-check-label" for="curso{{ $curso->id_curso }}">{{ $curso->nombre_curso }}</label>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('estudiantes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
