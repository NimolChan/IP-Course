<?php

namespace Tests\Feature;


use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;

class ProductTest extends TestCase
{
    /**
     * Test ID: Product-001
     * Description: Verify product creation functionality with valid data
     * Precondition: A valid category exists
     * Test Steps:
     * 1. Send a POST request to /api/products with valid data
     * 2. Check the response status
     * 3. Verify the product exists in the database
     * Test Data:
     * name: Laptop
     * description: High-performance gaming laptop
     * pricing: 1500
     * category_id: 1
     * Expected Result: Product is created with a 201 status
     * Actual Result:
     * Status: (Pass/Fail)
     * Remarks: N/A
     */

    /**
     * Test ID: Product-002
     * Description: Verify retrieval of product details by ID
     * Precondition: A product with ID 1 exists
     * Test Steps:
     * 1. Send a GET request to /api/products/{id}
     * 2. Check the response status and product details
     * Test Data:
     * id: 1
     * Expected Result: Response contains product details with a 200 status
     * Actual Result:
     * Status: (Pass/Fail)
     * Remarks: N/A
     */

    /**
     * Test ID: Product-003
     * Description: Verify product update functionality
     * Precondition: A product with ID 1 exists
     * Test Steps:
     * 1. Send a PUT request to /api/products/{id} with new data
     * 2. Check the response status and verify database update
     * Test Data:
     * id: 1
     * name: Gaming Laptop
     * Expected Result: Product name updates to 'Gaming Laptop' with a 200 status
     * Actual Result:
     * Status: (Pass/Fail)
     * Remarks: Ensure partial updates work correctly
     */

    /**
     * Test ID: Product-004
     * Description: Verify that a product cannot be created with an invalid category
     * Precondition: No category with ID 999 exists
     * Test Steps:
     * 1. Send a POST request to /api/products with category_id 999
     * 2. Check the response for validation error
     * Test Data:
     * name: Smartphone
     * category_id: 999
     * Expected Result: Response returns a 422 status with an invalid category error
     * Actual Result:
     * Status: (Pass/Fail)
     * Remarks:
     */

    /**
     * Test ID: Product-005
     * Description: Verify that a product can be deleted by id
     * Precondition: A product with ID 1 exists
     * Test Steps:
     * 1. Verify that a product with ID 1 exists
     * 2. Send a DELETE request to /api/products/{id}
     * 3. Check the response status and verify database deletion
     * Test Data:
     * name: Laptop
     * description: Gaming laptop
     * pricing: 1500
     * category_id: $category->id
     * Expected Result: $category->id is the id that was deleted
     * Actual Result: can be deleted successfully
     * Status: (Pass/Fail)
     * Remarks:
     */
    public function test_create_product_with_valid_data()
    {
        $category = Category::create(['name' => 'Electronics']);

        $response = $this->post('/api/products', [
            'name' => 'Laptop',
            'description' => 'High-performance gaming laptop',
            'pricing' => 1500,
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('products', ['name' => 'Laptop']);
    }

    public function test_retrieve_product_by_id()
    {
        $category = Category::create(['name' => 'Electronics']);
        $product = Product::create([
            'name' => 'Laptop',
            'description' => 'Gaming laptop',
            'pricing' => 1500,
            'category_id' => $category->id,
        ]);

        $response = $this->get('/api/products/' . $product->id);

        $response->assertStatus(200);
        $response->assertJson(['name' => 'Laptop']);
    }

    public function test_update_product()
    {
        $category = Category::create(['name' => 'Electronics']);
        $product = Product::create([
            'name' => 'Old Laptop',
            'description' => 'Old model',
            'pricing' => 1200,
            'category_id' => $category->id,
        ]);

        $response = $this->patch('/api/products/' . $product->id, [
            'name' => 'Gaming Laptop',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('products', ['name' => 'Gaming Laptop']);
    }

    public function test_create_product_with_invalid_category()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Test Product',
            'description' => 'This is a test product',
            'pricing' => 999,
            'category_id' => 9999, // Invalid category
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['category_id']);
    }

    public function test_delete_product_by_id()
    {
        $category = Category::create(['name' => 'Electronics']);
        $product = Product::create([
            'name' => 'Laptop',
            'description' => 'Gaming laptop',
            'pricing' => 1500,
            'category_id' => $category->id,
        ]);

        $response = $this->delete('/api/products/'. $product->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
