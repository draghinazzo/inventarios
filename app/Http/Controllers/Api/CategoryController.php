<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Listar todas las categorías
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    // Crear categoría
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    // Mostrar categoría
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category, 200);
    }

    // Actualizar categoría
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return response()->json($category, 200);
    }

    // Eliminar categoría
    public function destroy($id)
    {
        Category::destroy($id);
        return response()->json(null, 204);
    }
}