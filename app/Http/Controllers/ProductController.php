<?php

namespace App\Http\Controllers;
use App\Models\Product;
use http\Env\Response;
use Illuminate\Http\Request;

class ProductController
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        $product = Product::find($id);
        if ($product!= []) {
            return response()->json($product, 200);
        }
        return response(null, 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:products',
            'price' => 'required'
            ]);

        return response()->json($request, 201);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return response()->json($product, 200);
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(204);
    }
}

