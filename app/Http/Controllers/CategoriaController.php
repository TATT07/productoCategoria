<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Listar todas las categorías
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Mostrar formulario para crear categoría
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Guardar nueva categoría
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:200',
            'activa' => 'nullable|boolean',
        ]);

        // Si el checkbox está marcado, el valor será true
        $validated['activa'] = $request->has('activa');

        Categoria::create($validated);

        return redirect()->route('categorias.index')
            ->with('success', '✅ Categoría creada exitosamente.');
    }

    /**
     * Mostrar una categoría específica
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Mostrar formulario para editar categoría
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar categoría
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:200',
            'activa' => 'nullable|boolean',
        ]);

        $validated['activa'] = $request->has('activa');

        $categoria->update($validated);

        return redirect()->route('categorias.index')
            ->with('success', '✅ Categoría actualizada exitosamente.');
    }

    /**
     * Eliminar categoría
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('categorias.index')
            ->with('success', '🗑️ Categoría eliminada correctamente.');
    }
}
