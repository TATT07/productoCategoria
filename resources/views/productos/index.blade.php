@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Productos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-3">
        <div>
            <a href="{{ route('productos.create') }}" class="btn btn-primary me-2">➕ Nuevo producto</a>
            <a href="{{ route('productos.pdf') }}" class="btn btn-danger">📄 Generar PDF</a>
        </div>

        <div class="d-flex align-items-center">
            <label for="filtro_categoria" class="me-2 mb-0 fw-bold">Filtrar por categoría:</label>
            <select id="filtro_categoria" class="form-select form-select-sm" style="width: 220px;">
                <option value="">Todas</option>
                @foreach(\App\Models\Categoria::orderBy('nombre')->get() as $cat)
                    <option value="{{ $cat->nombre }}">{{ $cat->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="table table-bordered table-hover" id="tabla-productos">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>

                    <td>
                        @if ($producto->foto)
                            <img src="{{ asset('storage/' . $producto->foto) }}"
                                 alt="Foto"
                                 width="60" height="60"
                                 style="object-fit: cover; border-radius:8px;">
                        @else
                            <span class="text-muted">Sin imagen</span>
                        @endif
                    </td>

                    <td>{{ $producto->nombre }}</td>
                    <td>${{ number_format($producto->precio, 2, ',', '.') }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>

                    <td>
                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
    {{-- jQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- DataTables + Buttons --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inicializamos DataTable
            let tabla = $('#tabla-productos').DataTable({
                pageLength: 10,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '📥 Exportar a Excel',
                        className: 'btn btn-success btn-sm mb-3'
                    }
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.8/i18n/es-ES.json'
                }
            });

            // Filtro por categoría usando búsqueda de la columna 5 (Categoría)
            $('#filtro_categoria').on('change', function () {
                let valor = $(this).val();

                if (valor) {
                    // Coincidencia simple
                    tabla.column(5).search(valor, false, false).draw();
                } else {
                    // Quitar filtro
                    tabla.column(5).search('').draw();
                }
            });
        });
    </script>
@endsection
