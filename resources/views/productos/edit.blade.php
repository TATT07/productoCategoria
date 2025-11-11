@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Producto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('productos.update', $producto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre *</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="{{ old('nombre', $producto->nombre) }}">
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio *</label>
            <input type="number" step="0.01" class="form-control" id="precio" name="precio" required value="{{ old('precio', $producto->precio) }}">
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock *</label>
            <input type="number" class="form-control" id="stock" name="stock" required value="{{ old('stock', $producto->stock) }}">
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoría *</label>
            <select name="categoria_id" id="categoria_id" class="form-select" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            @if($producto->foto)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$producto->foto) }}" width="100" height="100" class="rounded">
                </div>
            @endif
            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">💾 Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">⬅ Volver</a>
    </form>
</div>
@endsection
