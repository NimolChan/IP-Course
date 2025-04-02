<?php
namespace Tests\EnvironmentTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
    /** @test */
    public function it_checks_the_testing_environment_variables()
    {
        $this->assertEquals('testing', env('APP_ENV'));
        $this->assertEquals('mysql', env('DB_CONNECTION'));
        $this->assertEquals('db_test', env('DB_HOST'));
        $this->assertEquals('9001', env('DB_PORT'));
        $this->assertEquals('laravel_test', env('DB_DATABASE'));
        $this->assertEquals('laravel_test', env('DB_USERNAME'));
        $this->assertEquals('laravel_test', env('DB_PASSWORD'));

        // Ensure the database can be connected
        // $this->assertNotNull(DB::connection()->getPdo());
    }
}
