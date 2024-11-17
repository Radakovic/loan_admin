<?php

namespace Tests\Feature\Product;

use App\Models\Adviser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductListTest extends TestCase
{
    use RefreshDatabase;

    private Adviser $adviser;
    protected function setUp(): void
    {
        parent::setUp();
        $this->adviser = Adviser::factory()->create();
    }
    /**
     * Unauthenticated users will be redirected to login page
     */
    public function testUnauthenticatedRedirectToLoginPage(): void
    {
        $response = $this->get('/products');
        $response->assertStatus(302);
        $response->assertRedirect(route('login', absolute: false));
    }
    /**
     * Authenticated users can go to Product list page
     */
    public function testAccessToProductListPage(): void
    {
        $response = $this->actingAs($this->adviser)->get('/products');
        $response->assertStatus(200);
    }
}
