<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProducts() {
        return ["message" => "Getting list of products"];
    }

    public function createProduct(Request $request) {
        return ["message" => "Creating 1 new products"];
    }

    public function getProduct($productId) {
        return ["message" => "Getting 1 product base on given product"];
    }

    public function updateProduct(Request $request, $productId) {
        // $product = Product::findOrFail($productId);
        // $product->update($request->all());
        // return $product;
        return ["message" => "Update 1 product base on given product"];
    }

    public function deleteProduct($productId) {
        return ["message" => "delete 1 product base on given product"];
    }
}
