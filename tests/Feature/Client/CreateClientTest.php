<?php

namespace Tests\Feature\Client;

use App\Models\Adviser;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateClientTest extends TestCase
{
    use RefreshDatabase;

    private Adviser $adviser;
    protected function setUp(): void
    {
        parent::setUp();
        $this->adviser = Adviser::factory()->create();
    }
    /**
     * Unauthorized user can not create client
     */
    public function testUnauthorizedUserCantCreateClient(): void
    {
        $response = $this->get('/clients/create');
        $response->assertStatus(302);
        $response->assertRedirect(route('login', absolute: false));
    }

    /**
     * Authorized user can see form
     */
    public function testCreateClientForm(): void
    {
        $response = $this->actingAs($this->adviser)->get('/clients/create');
        $response->assertStatus(200);
    }

    /**
     * Test shows how to create client
     */
    public function testCreateClient(): void
    {
        $clients = Client::all();
        self::assertCount(0, $clients);
        $response = $this->actingAs($this->adviser)->post('/clients', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '0123456789',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index', absolute: false));

        $clients = Client::all();
        self::assertCount(1, $clients);
    }
}
