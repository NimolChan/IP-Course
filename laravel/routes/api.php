<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Category Routes
Route::controller(CategoryController::class)->prefix('categories')->group(function() {
    Route::get('/', 'getCategories'); // Get all categories
    Route::post('/', 'createCategory'); // Create a new category
    Route::get('/{categoryId}', 'getCategory'); // Get a single category by ID
    Route::patch('/{categoryId}', 'updateCategory'); // Update a category
    Route::delete('/{categoryId}', 'deleteCategory'); // Delete a category
});

// Product Routes
Route::controller(ProductController::class)->prefix('products')->group(function() {
    Route::get('/', 'getProducts'); // Get all products
    Route::post('/', 'createProduct'); // Create a new product
    Route::get('/{productId}', 'getProduct'); // Get a single product by ID
    Route::patch('/{productId}', 'updateProduct'); // Update a product
    Route::delete('/{productId}', 'deleteProduct'); // Delete a product
});

// Get all products under a specific category
Route::get('/categories/{categoryId}/products', [ProductController::class, 'getProductsByCategory']);
Route::patch('/products/{productId}', [ProductController::class, 'updateProduct']);

