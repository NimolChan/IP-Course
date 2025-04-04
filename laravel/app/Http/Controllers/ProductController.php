<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function getProducts()
    {
        $products = Product::with('category')->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'pricing' => 'required|numeric',
            'description' => 'nullable|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048' // Validate images
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store each image in the public/products directory
                $path = $image->store('products', 'public');
                $imagePaths[] = $path; // Store the file path in an array
            }
        }

        $product = Product::create([
        'name' => $validated['name'],
        'category_id' => $validated['category_id'],
        'pricing' => $validated['pricing'],
        'description' => $validated['description'] ?? null,
        'images' => json_encode($imagePaths),
        ]);


        if(!$product){
            return response()->json(['message' => 'Error creating product'], 400);
        }

        return response()->json(['message' => 'Creating a new product', 'product' => $product], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getProduct( $productId)
    {
        $product = Product::with('category')->find($productId);

        return response()->json($product);
    }

    /**
     * Display the specified resource.
     */
    public function updateProduct(Request $request, $productId)
    {
        $product = Product::find($productId);

        $product = $product->update($request->all());

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => $product
        ]);
    }

    public function deleteProduct( $productId)
    {
        $product = Product::find($productId);

        if ($product->images) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
