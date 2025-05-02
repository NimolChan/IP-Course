<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Http\Request;

class CategoryTest extends TestCase
{

    public function test_get_all_categories()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }

    public function test_create_category()
    {
        $response = $this->post('/api/categories', ['name' => 'Categories']);
        $response->assertStatus(200);
    }

    public function test_category_name_required()
    {
        $response = $this->post('/api/categories', []);
        $response->assertStatus(500);
    }

    public function test_update_category()
    {
        $category = Category::create(['name' => 'MY Category']);
        $response = $this->put("/api/categories/{$category->id}", ['name' => 'Updated Electronics']);
        $response->assertStatus(405);
    }

    public function test_delete_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $response = $this->delete("/api/categories/{$category->id}");
        $response->assertStatus(200);
    }


    public function test_soft_delete_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $category->delete();
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    public function test_get_single_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $response = $this->get("/api/categories/{$category->id}");
        $response->assertStatus(200);
    }

    public function test_restore_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $category->delete();
        $category->restore();
        $this->assertNotSoftDeleted('categories', ['id' => $category->id]);
    }

    public function test_get_categories_list()
    {
        $category = Category::create(['name' => 'Electronics']);
        $response = $this->get('/api/categories');
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'created_at', 'updated_at']
        ]);
    }
    public function test_category_count()
    {
        $initialCount = Category::count();
        $response = $this->post('/api/categories', ['name' => 'New Category']);
        $newCount = Category::count();
        $this->assertEquals($initialCount + 1, $newCount);
    }
}
