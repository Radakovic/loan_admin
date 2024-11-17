<?php

namespace Tests\Feature\Product;

use App\Enum\ProductTypeEnum;
use App\Models\Adviser;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductHomeLoanTest extends TestCase
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
     * Test will show create new home loan for given client
     */
    public function testCreateHomeLoanForClient(): void
    {
        $client = Client::with('products')->find($this->client->id);
        self::assertCount(0, $client->products);

        $response = $this->actingAs($this->adviser)->put('/products/home_loan', [
            'property_value' => 250000,
            'down_payment_amount' => 27000,
            'type' => 'HOME_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index', absolute: false));

        $this->assertHomeLoanDetails(propertyValue: 25000000, downAmount: 2700000);
    }
    /**
     * Test will show update existing Home loan for client
     */
    public function testUpdateHomeLoanForClient(): void
    {
        $product = $this->createProduct();
        $client = Client::with('products')->find($this->client->id);

        self::assertCount(1, $client->products);
        $this->assertHomeLoanDetails(
            propertyValue: $product->property_value,
            downAmount: $product->down_payment_amount
        );

        $url = sprintf('/products/home_loan/%s', $product->id);
        $response = $this->actingAs($this->adviser)->put($url, [
            'property_value' => 250000,
            'down_payment_amount' => 27000,
            'type' => 'HOME_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index', absolute: false));

        $this->assertHomeLoanDetails(propertyValue: 25000000, downAmount: 2700000);
    }

    /**
     * Adviser can update only products which is created by him
     */
    public function testUnauthorizedAdviser(): void
    {
        $product = $this->createProduct();
        $client = Client::with('products')->find($this->client->id);

        self::assertCount(1, $client->products);
        $this->assertHomeLoanDetails(
            propertyValue: $product->property_value,
            downAmount: $product->down_payment_amount
        );

        $otherAdviser = Adviser::factory()->create();
        $url = sprintf('/products/home_loan/%s', $product->id);
        $response = $this->actingAs($otherAdviser)->put($url, [
            'property_value' => 250000,
            'down_payment_amount' => 27000,
            'type' => 'HOME_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);

        $response->assertStatus(403);
    }
    /**
     * Assert home loan product data
     */
    private function assertHomeLoanDetails(int $propertyValue, int $downAmount): void
    {
        $client = Client::with('products')->find($this->client->id);
        self::assertCount(1, $client->products);
        self::assertEquals($propertyValue, $client->products->first()->property_value);
        self::assertEquals($downAmount, $client->products->first()->down_payment_amount);
        self::assertEquals(ProductTypeEnum::HOME_LOAN->value, $client->products->first()->type);
    }

    private function createProduct(): Product
    {
        return Product::factory()->create([
            'property_value' => 320000,
            'down_payment_amount' => 4800,
            'type' => 'HOME_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);
    }
}
