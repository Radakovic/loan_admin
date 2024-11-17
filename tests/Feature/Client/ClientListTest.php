<?php

namespace Tests\Feature\Client;

use App\Models\Adviser;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientListTest extends TestCase
{
    use RefreshDatabase;

    private Adviser $adviser;
    protected function setUp(): void
    {
        parent::setUp();
        Client::factory(2)->create();
        $this->adviser = Adviser::factory()->create();
    }
    /**
     * Unauthenticated users will be redirected to login page
     */
    public function testUnauthenticatedRedirectToLoginPage(): void
    {
        $response = $this->get('/clients');
        $response->assertStatus(302);
        $response->assertRedirect(route('login', absolute: false));
    }
    /**
     * Authenticated users can go to Client list page
     */
    public function testAccessToClientListPage(): void
    {
        $response = $this->actingAs($this->adviser)->get('/clients');
        $response->assertStatus(200);
    }
}
