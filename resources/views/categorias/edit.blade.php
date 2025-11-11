@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Categoría</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{ old('nombre', $categoria->nombre) }}">
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion">{{ old('descripcion', $categoria->descripcion) }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="activa" name="activa" value="1" {{ $categoria->activa ? 'checked' : '' }}>
            <label class="form-check-label" for="activa">Activa</label>
        </div>

        <button type="submit" class="btn btn-primary">💾 Actualizar</button>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">⬅ Volver</a>
    </form>
</div>
@endsection
