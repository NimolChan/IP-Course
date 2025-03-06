<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // get /api/category
    public function getCategories() {
        return ["message" => "Getting list of categories"];
    }

    public function createCategory(){

        return ["message" => "Creating 1 new category"];
    }
    public function getCategory($categoryId) {
        return ["message" => "Getting 1 category base on given category"];
    }
    public function updateCategory($categoryId) {
        return ["message" => "Update 1 category base on given category"];
    }
    public function deleteCategory($categoryId) {
        return ["message" => "delete 1 category base on given category"];
    }
}
