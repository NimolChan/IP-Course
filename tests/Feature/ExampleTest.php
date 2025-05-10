<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic feature test example.
     * Test ID : Cart-001
     * Description :
     * Precondition : none
     * Test Steps :
     * Test Data:
     * Expected Result :
     * Actual Result :
     * Status :
     * Remarks :
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
