<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Test ID: Category-001
     * Description: Verify category creation functionality with valid data
     * Precondition: User must be authenticated
     * Test Steps:
     * 1. Send a POST request to /api/categories with a valid 'name'
     * 2. Check the response status
     * 3. Verify the new category exists in the database
     * Test Data:
     * name: Electronics
     * Expected Result: The category is created and returns a 201 status with the category details
     * Actual Result:
     * Status: (Pass/Fail)
     * Remarks: N/A
     */

    /**
     * Test ID: Category-002
     * Description: Verify that a category can be updated with new data
     * Precondition: A category with the name 'Electronics' exists
     * Test Steps:
     * 1. Send a PUT request to /api/categories/{id} with new 'name' data
     * 2. Check the response status
     * 3. Verify the category is updated in the database
     * Test Data:
     * id: 1
     * name: Smartphones
     * Expected Result: The category name is updated to 'Smartphones' and a 200 status is returned
     * Actual Result:
     * Status: (Pass/Fail)
     * Remarks: N/A
     */

    /**
     * Test ID: Category-003
     * Description: Verify that a category can be deleted by id
     * Precondition: A category with ID 1 exists
     * Test Steps:
     * 1. Send a DELETE request to /api/categories/{id}
     * 2. Check the response for failure due to products attached to the category
     * Test Data:
     * id: 1 (assuming category with products exists)
     * Expected Result: Response status should be
     * Actual Result:
     * Status: (Pass/Fail)
     * Remarks:
     */

    /**
    * Test ID: Category-004
    * Description: Verify that categories are listed correctly
    * Precondition: Multiple categories exist in the database
    * Test Steps:
    * 1. Send a GET request to /api/categories
    * 2. Check the response for a list of categories
    * Test Data:
    * N/A
    * Expected Result: Response contains a list of categories with status code 200
    * Actual Result:
    * Status: (Pass/Fail)
    * Remarks: N/A
    */

    /**
    * Test ID: Category-005
    * Description: Verify that categories are view all
    * Precondition: can view all categories
    * Test Steps:
    * 1. Send a GET request to /api/categories
    * 2. Check the response for a category that already created to view all categories
    * Test Data: categories
    * Expected Result: Response contains a list of categories with status code 200
    * Actual Result:
    * Status: (Pass/Fail)
    * Remarks: N/A
    */

    public function test_create_category_with_valid_data()
    {
        $uniqueName = 'Electronics-' . time();

        $response = $this->post('/api/categories', [
            'name' => $uniqueName,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('categories', ['name' => 'Electronics']);
    }

    public function test_update_category()
    {
        $category = Category::create(['name' => 'Electronics-' . time()]);

        $uniqueUpdatedName = 'Smartphones-' . time();

        $response = $this->patch('/api/categories/' . $category->id, [
            'name' => $uniqueUpdatedName,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', ['name' => $uniqueUpdatedName]);
    }

    public function test_delete_category_by_id()
    {
        $category = Category::create(['name' => 'Electronics']);

        $response = $this->delete('/api/categories/' . $category->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    public function test_retrieve_categories()
    {
        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Fashion']);

        $response = $this->get('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonCount(2);
        $response->assertJsonFragment(['name' => 'Electronics']);
        $response->assertJsonFragment(['name' => 'Fashion']);
    }

    public function test_view_all_categories()
    {
        $category = Category::create(['name' => 'Electronics']);

        $response = $this->get('/api/categories/' . $category->id);

        $response->assertStatus(200);
        $response->assertJsonFragment(['name' => 'Electronics']);
    }
}
