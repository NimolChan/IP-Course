<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getCategories()
    {
        $categories = Category::all();
        return response()->json(['message' => 'Get all categories', 'categories' => $categories], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $category = Category::create([
            'name' => $validatedData['name'],
        ]);


        return response()->json(['message' => 'Creating a new category', 'category' => $category], 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getCategory( $categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json($category);
    }

    /**
     * Display the specified resource.
     */
    public function updateCategory(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $categoryId,
        ]);

        $category->update($validatedData);
        return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
    }

    public function deleteCategory( $categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Prevent deletion if there are associated products
        if ($category->products()->count() > 0) {
            return response()->json(['error' => 'Category has products and cannot be deleted'], 400);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }

}
