@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Curso</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('cursos.update', $curso->id_curso) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre_curso" class="form-control" value="{{ $curso->nombre_curso }}" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" value="{{ $curso->descripcion }}" required>
        </div>
        <div class="mb-3">
            <label>Créditos</label>
            <input type="number" name="creditos" class="form-control" value="{{ $curso->creditos }}" required>
        </div>
        <div class="mb-3">
            <label>Profesor</label>
            <input type="text" name="profesor" class="form-control" value="{{ $curso->profesor }}" required>
        </div>
        <div class="mb-3">
            <label>Tipo</label>
            <select name="tipo" class="form-control" required>
                <option value="obligatorio" @if($curso->tipo=='obligatorio') selected @endif>Obligatorio</option>
                <option value="electivo" @if($curso->tipo=='electivo') selected @endif>Electivo</option>
                <option value="taller" @if($curso->tipo=='taller') selected @endif>Taller</option>
                <option value="seminario" @if($curso->tipo=='seminario') selected @endif>Seminario</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Cupo Máximo</label>
            <input type="number" name="cupo_maximo" class="form-control" value="{{ $curso->cupo_maximo }}" required>
        </div>
        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
