<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json(Brand::all(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255|unique:brands',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('brands', 'public');
        }

        $brand = Brand::create($data);
        return response()->json($brand, 201);
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        return response()->json($brand, 200);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255|unique:brands,name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // eliminar imagen anterior
            if ($brand->image && Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }
            $data['image'] = $request->file('image')->store('brands', 'public');
        }

        $brand->update($data);
        return response()->json($brand, 200);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        if ($brand->image && Storage::disk('public')->exists($brand->image)) {
            Storage::disk('public')->delete($brand->image);
        }
        $brand->delete();
        return response()->json(null, 204);
    }
}
