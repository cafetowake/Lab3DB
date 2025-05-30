@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nueva Asistencia</h1>
    <form action="{{ route('asistencias.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Inscripción</label>
            <select name="id_inscripcion" class="form-control" required>
                @foreach($inscripciones as $insc)
                    <option value="{{ $insc->id_inscripcion }}">
                        {{ $insc->estudiante->nombre }} {{ $insc->estudiante->apellido }} - {{ $insc->curso->nombre_curso }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Presente</label>
            <select name="presente" class="form-control" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Observaciones</label>
            <input type="text" name="observaciones" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
