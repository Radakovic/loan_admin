<?php

namespace Tests\Feature\Client;

use App\Models\Adviser;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientDeleteTest extends TestCase
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
     * Test will show how to delete client
     */
    public function testDeleteClient(): void
    {
        $clients = Client::all();
        self::assertCount(1, $clients);

        $url = sprintf('/clients/%s', $this->client->id);
        $response = $this->actingAs($this->adviser)->delete($url);

        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index', absolute: false));

        $clients = Client::all();
        self::assertCount(0, $clients);
    }
}
