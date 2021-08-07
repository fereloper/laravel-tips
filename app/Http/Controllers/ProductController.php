<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'data' => $products,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'category_id' => 'required|exists:category,id',
        ]);

        $product = Product::create([
            'name' => $validatedData['name'],
            'type' => $validatedData['type'],
            'category_id' => $validatedData['category_id'],
        ]);

        return response()->json([
            'data' => $product
        ]);
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'category_id' => 'required|exists:category,id',
        ]);

        $product->name = $validatedData['name'];
        $product->type = $validatedData['type'];
        $product->category_id = $validatedData['category_id'];

        $product->save();

        return response()->json([
            'data' => $product
        ]);
    }
}
