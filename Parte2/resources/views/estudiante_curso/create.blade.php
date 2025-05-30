@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Inscripción</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('estudiante_curso.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Estudiante</label>
            <select name="id_estudiante" class="form-control" required>
                @foreach($estudiantes as $est)
                    <option value="{{ $est->id_estudiante }}">{{ $est->nombre }} {{ $est->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Curso</label>
            <select name="id_curso" class="form-control" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id_curso }}">{{ $curso->nombre_curso }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Fecha de Inscripción</label>
            <input type="date" name="fecha_inscripcion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Calificación</label>
            <input type="number" name="calificacion" class="form-control" min="0" max="100">
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="activa">Activa</option>
                <option value="cancelada">Cancelada</option>
                <option value="completada">Completada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('estudiante_curso.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
