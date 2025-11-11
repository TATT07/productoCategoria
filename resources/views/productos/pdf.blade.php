<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Productos</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .titulo {
            text-align: center;
            margin-bottom: 10px;
        }
        .titulo h2 { margin: 0; }
        .logo {
            text-align: left;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #555;
            padding: 4px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
        }
        .resumen {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="logo">
        {{-- Si tienes un logo en public/img/logo.png, descomenta la línea de abajo --}}
        {{-- <img src="{{ public_path('img/logo.png') }}" alt="Logo" height="50"> --}}
    </div>

    <div class="titulo">
        <h2>Reporte de Productos</h2>
        <p>Fecha: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productos as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->nombre }}</td>
                <td>{{ $p->categoria->nombre ?? 'Sin categoría' }}</td>
                <td>${{ number_format($p->precio, 2, ',', '.') }}</td>
                <td>{{ $p->stock }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="resumen">
        Total en stock: {{ $totalStock }} unidades <br>
        Valor total del inventario: ${{ number_format($totalValor, 2, ',', '.') }}
    </div>
</body>
</html>
