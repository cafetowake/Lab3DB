@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Asistencia</h1>
    <form action="{{ route('asistencias.update', $asistencia->id_asistencia) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Inscripción</label>
            <select name="id_inscripcion" class="form-control" required>
                @foreach($inscripciones as $insc)
                    <option value="{{ $insc->id_inscripcion }}" @if($asistencia->id_inscripcion == $insc->id_inscripcion) selected @endif>
                        {{ $insc->estudiante->nombre }} {{ $insc->estudiante->apellido }} - {{ $insc->curso->nombre_curso }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Fecha</label>
            <input type="date" name="fecha" class="form-control" value="{{ $asistencia->fecha }}" required>
        </div>
        <div class="mb-3">
            <label>Presente</label>
            <select name="presente" class="form-control" required>
                <option value="1" @if($asistencia->presente) selected @endif>Sí</option>
                <option value="0" @if(!$asistencia->presente) selected @endif>No</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Observaciones</label>
            <input type="text" name="observaciones" class="form-control" value="{{ $asistencia->observaciones }}">
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('asistencias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
