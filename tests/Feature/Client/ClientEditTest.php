<?php

namespace Tests\Feature\Client;

use App\Models\Adviser;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientEditTest extends TestCase
{
    use RefreshDatabase;

    private Adviser $adviser;
    private Client $client;
    protected function setUp(): void
    {
        parent::setUp();
        $this->adviser = Adviser::factory()->create();
        $this->client = Client::factory()->create();
    }
    /**
     * Unauthorized user can not edit client
     */
    public function testUnauthorizedUserCantEditClient(): void
    {
        $url = sprintf('/clients/%s/edit', $this->client->id);
        $response = $this->get($url);
        $response->assertStatus(302);
        $response->assertRedirect(route('login', absolute: false));
    }
    /**
     * Only authorized user can access to edit client form
     */
    public function testAccessToEditClientForm(): void
    {
        $url = sprintf('/clients/%s/edit', $this->client->id);
        $response = $this->actingAs($this->adviser)->get($url);
        $response->assertStatus(200);
    }
    /**
     * Test will show edited client personal info
     */
    public function testEditClientPersonalInfo(): void
    {
        $clients = Client::all();
        self::assertCount(1, $clients);

        $url = sprintf('/clients/%s', $this->client->id);
        $response = $this->actingAs($this->adviser)->patch($url, [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'phone' => '0123456789',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index', absolute: false));

        $this->assertClientData();
    }
    /**
     * Assert new personal data of client
     */
    private function assertClientData(): void
    {
        $client = Client::get()->first();
        self::assertEquals($this->client->id, $client->id);
        self::assertEquals('John', $client->first_name);
        self::assertEquals('Doe', $client->last_name);
        self::assertEquals('john.doe@example.com', $client->email);
        self::assertEquals('0123456789', $client->phone);
    }
}
