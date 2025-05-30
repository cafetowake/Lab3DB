@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Nuevo Curso</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre_curso" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Descripción</label>
            <input type="text" name="descripcion" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Créditos</label>
            <input type="number" name="creditos" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Profesor</label>
            <input type="text" name="profesor" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tipo</label>
            <select name="tipo" class="form-control" required>
                <option value="obligatorio">Obligatorio</option>
                <option value="electivo">Electivo</option>
                <option value="taller">Taller</option>
                <option value="seminario">Seminario</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Cupo Máximo</label>
            <input type="number" name="cupo_maximo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
