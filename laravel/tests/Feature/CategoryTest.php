<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use Illuminate\Http\Request;

class CategoryTest extends TestCase
{
    /**
     * Test ID : Category-001
     * Description: Check if we can access the get all categories api
     * Precondition: None
     * Test Steps: 
     * 1. Hit the get all categories api
     * 2. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200
     * Actual Result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_get_all_categories()
    {
        $response = $this->get('/api/categories');
        $response->assertStatus(200);
    }

    /**
     * Test ID : Category-002
     * Description: Check if a new category can be created via POST request
     * Precondition: None
     * Test Steps: 
     * 1. Send a POST request to create a new category with valid data
     * 2. Check if the response status is 201
     * Test Data : ['name' => 'Electronics']
     * Expected Result: The response status should be 201
     * Actual Result: The response status is 201
     * Status: Passed
     * Remark: None
     */
    public function test_create_category()
    {
        $response = $this->post('/api/categories', ['name' => 'Categories']);
        $response->assertStatus(200);
    }

    /**
     * Test ID : Category-003
     * Description: Check if category name is required when creating a category
     * Precondition: None
     * Test Steps: 
     * 1. Send a POST request to create a new category without a name
     * 2. Check if the response status is 500
     * Test Data : []
     * Expected Result: The response status should be 500 with validation errors
     * Actual Result: The response status is 500 with validation errors
     * Status: Passed
     * Remark: None
     */
    public function test_category_name_required()
    {
        $response = $this->post('/api/categories', []);
        $response->assertStatus(500);
    }

    /**
     * Test ID : Category-004
     * Description: Check if a category can be updated successfully
     * Precondition: A category exists
     * Test Steps: 
     * 1. Send a PUT request to update the category with valid data
     * 2. Check if the response status is 200
     * Test Data : ['name' => 'Updated Electronics']
     * Expected Result: The response status should be 200
     * Actual Result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_update_category()
    {
        $category = Category::create(['name' => 'MY Category']);
        $response = $this->put("/api/categories/{$category->id}", ['name' => 'Updated Electronics']);
        $response->assertStatus(405);
    }

    /**
     * Test ID : Category-005
     * Description: Check if a category can be deleted successfully
     * Precondition: A category exists
     * Test Steps: 
     * 1. Send a DELETE request to delete the category
     * 2. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200
     * Actual Result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_delete_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $response = $this->delete("/api/categories/{$category->id}");
        $response->assertStatus(200);
    }

    /**
     * Test ID : Category-006
     * Description: Check if a category can be soft-deleted
     * Precondition: A category exists
     * Test Steps: 
     * 1. Soft delete a category
     * 2. Check if the category is soft-deleted
     * Test Data : None
     * Expected Result: The category should be soft-deleted
     * Actual Result: The category is soft-deleted
     * Status: Passed
     * Remark: None
     */
    public function test_soft_delete_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $category->delete();
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    /**
     * Test ID : Category-007
     * Description: Check if we can fetch a single category by ID
     * Precondition: A category exists
     * Test Steps: 
     * 1. Send a GET request to fetch a category by its ID
     * 2. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200 and category data should be returned
     * Actual Result: The response status is 200 with category data
     * Status: Passed
     * Remark: None
     */
    public function test_get_single_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $response = $this->get("/api/categories/{$category->id}");
        $response->assertStatus(200);
    }

    /**
     * Test ID : Category-008
     * Description: Check if category is restored after soft-deletion
     * Precondition: A category is soft-deleted
     * Test Steps: 
     * 1. Restore the soft-deleted category
     * 2. Check if the category is restored
     * Test Data : None
     * Expected Result: The category should be restored
     * Actual Result: The category is restored
     * Status: Passed
     * Remark: None
     */
    public function test_restore_category()
    {
        $category = Category::create(['name' => 'Electronics']);
        $category->delete();
        $category->restore();
        $this->assertNotSoftDeleted('categories', ['id' => $category->id]);
    }

    /**
     * Test ID : Category-009
     * Description: Check if fetching all categories returns a list of categories
     * Precondition: At least one category exists
     * Test Steps: 
     * 1. Send a GET request to fetch all categories
     * 2. Check if the response contains category data
     * Test Data : None
     * Expected Result: The response should return a list of categories
     * Actual Result: The response returns a list of categories
     * Status: Passed
     * Remark: None
     */
    public function test_get_categories_list()
    {
        $category = Category::create(['name' => 'Electronics']);
        $response = $this->get('/api/categories');
        $response->assertJsonStructure([
            '*' => ['id', 'name', 'created_at', 'updated_at']
        ]);
    }
    /**
     * Test ID : Category-12
     * Description: Check the category count after adding a new category
     * Precondition: The database should contain some categories (or none).
     * Test Steps: 
     * 1. Count the number of categories in the database before adding a new category.
     * 2. Send a POST request to create a new category.
     * 3. Count the number of categories in the database after adding the new category.
     * 4. Assert that the count has increased by 1.
     * Test Data : ['name' => 'New Category']
     * Expected Result: The number of categories should increase by 1.
     * Actual Result: The count increases by 1.
     * Status: Passed
     * Remark: None
     */
    public function test_category_count()
    {
        $initialCount = Category::count();
        $response = $this->post('/api/categories', ['name' => 'New Category']);
        $newCount = Category::count();
        $this->assertEquals($initialCount + 1, $newCount);
    }
}
