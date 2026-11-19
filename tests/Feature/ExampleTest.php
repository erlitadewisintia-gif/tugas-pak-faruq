<?php
// Deskripsi file: tests/Feature/ExampleTest.php
namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_guests_are_redirected_to_the_login_screen(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }

    public function test_landing_page_is_still_available(): void
    {
        $response = $this->get('/welcome');

        $response->assertOk();
    }
}
