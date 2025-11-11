<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductoController extends Controller
{

    public function index()
    {
        $productos = Producto::with('categoria')->orderBy('id', 'asc')->get();
        return view('productos.index', compact('productos'));
    }


    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('productos', 'public');
        }

        Producto::create($validated);

        return redirect()->route('productos.index')
                         ->with('success', '✅ Producto creado exitosamente.');
    }


    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }


    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }


    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:150',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('productos', 'public');
        }

        $producto->update($validated);

        return redirect()->route('productos.index')
                         ->with('success', '✅ Producto actualizado correctamente.');
    }


    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
                         ->with('success', '🗑️ Producto eliminado correctamente.');
    }

    public function exportPdf()
    {
        $productos = Producto::with('categoria')->orderBy('id', 'asc')->get();

        $totalStock = $productos->sum('stock');
        $totalValor = $productos->sum(function ($p) {
            return $p->stock * $p->precio;
        });

        $pdf = Pdf::loadView('productos.pdf', [
            'productos'   => $productos,
            'totalStock'  => $totalStock,
            'totalValor'  => $totalValor,
        ])->setPaper('a4', 'portrait');

        return $pdf->download('reporte_productos.pdf');
    }

}
