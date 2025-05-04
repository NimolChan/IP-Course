<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test ID: Category-001
     * Description: Verify category creation functionality with valid data
     * Expected Result: The category is created with a 201 status.
     */
    public function test_create_category_with_valid_data()
    {
        $uniqueName = 'Electronics-' . time();

        // Send POST request to create a new category
        $response = $this->post('/api/categories', [
            'name' => $uniqueName,
        ]);

        // Assert that the category was created successfully in the database
        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => $uniqueName]);
    }

    /**
     * Test ID: Category-002
     * Description: Verify that a category can be updated with new data.
     * Expected Result: Category name is updated with a 200 status.
     */
    public function test_update_category()
    {

        $category = Category::create(['name' => 'Electronics']);


        $updatedName = 'Smartphones-' . time();
        $response = $this->patch('/api/categories/' . $category->id, [
            'name' => $updatedName,
        ]);


        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['name' => $updatedName]);
    }

    /**
     * Test ID: Category-003
     * Description: Verify that a category can be deleted by id.
     * Expected Result: Category is deleted with a 200 status.
     */
    public function test_delete_category_by_id()
    {
        $category = Category::create(['name' => 'Electronics']);
        // Send DELETE request to delete the category
        $response = $this->delete('/api/categories/' . $category->id);

        // Assert that the category is deleted from the database
        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /**
     * Test ID: Category-004
     * Description: Verify categories are listed correctly.
     * Expected Result: Returns a list of categories with a 200 status.
     */
    public function test_retrieve_categories()
    {
        // Create categories to retrieve
        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Fashion']);

        // Send GET request to retrieve all categories
        $response = $this->get('/api/categories');

        // Assert the response status and check if the categories are present
        $response->assertStatus(200);
        $response->assertJsonCount(2);  // Ensure there are two categories
        $response->assertJsonFragment(['name' => 'Electronics']);
        $response->assertJsonFragment(['name' => 'Fashion']);
    }

    /**
     * Test ID: Category-005
     * Description: Verify that a category cannot be deleted if it has associated products.
     * Expected Result: Returns an error message if the category has associated products.
     */
    public function test_delete_category_with_products()
{
    // Create a category
    $category = Category::create(['name' => 'Electronics']);

    // Create a product within that category and provide all necessary fields
    Product::create([
        'name' => 'Laptop',
        'category_id' => $category->id,
        'pricing' => 1000, // Providing the 'pricing' value which is required
    ]);

    // Send DELETE request to try to delete the category
    $response = $this->delete('/api/categories/' . $category->id);

    // Assert that the category cannot be deleted due to associated products
    $response->assertStatus(200);
    $response->assertJson(['error' => 'Category has products and cannot be deleted']);
}

    /**
     * Test ID: Category-006
     * Description: Verify that categories can be viewed by ID.
     * Expected Result: Returns category details with a 200 status.
     */
    public function test_view_category_by_id()
    {
        // Create a category
        $category = Category::create(['name' => 'Electronics']);

        // Send GET request to view category by ID
        $response = $this->get('/api/categories/' . $category->id);

        // Assert that the correct category details are returned
        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Electronics']);
    }
}
