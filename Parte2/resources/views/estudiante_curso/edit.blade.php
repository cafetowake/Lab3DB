@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Inscripción</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('estudiante_curso.update', $inscripcion->id_inscripcion) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Estudiante</label>
            <select name="id_estudiante" class="form-control" required>
                @foreach($estudiantes as $est)
                    <option value="{{ $est->id_estudiante }}" @if($inscripcion->id_estudiante == $est->id_estudiante) selected @endif>{{ $est->nombre }} {{ $est->apellido }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Curso</label>
            <select name="id_curso" class="form-control" required>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id_curso }}" @if($inscripcion->id_curso == $curso->id_curso) selected @endif>{{ $curso->nombre_curso }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Fecha de Inscripción</label>
            <input type="date" name="fecha_inscripcion" class="form-control" value="{{ $inscripcion->fecha_inscripcion }}" required>
        </div>
        <div class="mb-3">
            <label>Calificación</label>
            <input type="number" name="calificacion" class="form-control" min="0" max="100" value="{{ $inscripcion->calificacion }}">
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <select name="estado" class="form-control" required>
                <option value="activa" @if($inscripcion->estado=='activa') selected @endif>Activa</option>
                <option value="cancelada" @if($inscripcion->estado=='cancelada') selected @endif>Cancelada</option>
                <option value="completada" @if($inscripcion->estado=='completada') selected @endif>Completada</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('estudiante_curso.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
