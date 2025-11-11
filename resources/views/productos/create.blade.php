@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Nuevo Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{ old('nombre') }}">
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio *</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required value="{{ old('precio') }}">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock *</label>
            <input type="number" class="form-control" id="stock" name="stock" required value="{{ old('stock') }}">
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría *</label>
            <select name="categoria_id" id="categoria_id" class="form-select" required>
                <option value="">Seleccione...</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">💾 Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">⬅ Volver</a>
    </form>
</div>
@endsection
