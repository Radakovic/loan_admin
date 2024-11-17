<?php

namespace Tests\Feature\Product;

use App\Enum\ProductTypeEnum;
use App\Models\Adviser;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCashLoanTest extends TestCase
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
     * Test will show create new Cash loan for given client
     */
    public function testCreateCashLoanForClient(): void
    {
        $client = Client::with('products')->find($this->client->id);
        self::assertCount(0, $client->products);

        $response = $this->actingAs($this->adviser)->put('/products/cash_loan', [
            'cash_loan_amount' => 2700,
            'type' => 'CASH_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index', absolute: false));

        $this->assertCashLoanDetails(270000);
    }
    /**
     * Test will show update existing Cash loan for client
     */
    public function testUpdateCashLoanForClient(): void
    {
        $product = $this->createProduct();
        $client = Client::with('products')->find($this->client->id);

        self::assertCount(1, $client->products);
        $this->assertCashLoanDetails(270000);

        $url = sprintf('/products/cash_loan/%s', $product->id);
        $response = $this->actingAs($this->adviser)->put($url, [
            'cash_loan_amount' => 5700,
            'type' => 'CASH_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);
        $response->assertStatus(302);
        $response->assertRedirect(route('clients.index', absolute: false));

        $this->assertCashLoanDetails(570000);
    }

    /**
     * Adviser can update only products which is created by him
     */
    public function testUnauthorizedAdviser(): void
    {
        $product = $this->createProduct();
        $client = Client::with('products')->find($this->client->id);

        self::assertCount(1, $client->products);
        $this->assertCashLoanDetails(270000);

        $otherAdviser = Adviser::factory()->create();
        $url = sprintf('/products/cash_loan/%s', $product->id);
        $response = $this->actingAs($otherAdviser)->put('/products/cash_loan', [
            'cash_loan_amount' => 5700,
            'type' => 'CASH_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);

        $response->assertStatus(403);
    }
    /**
     * Assert Cash loan product data
     * @param int $amount is stored in DB as 100 times bigger then given number in create form
     * @example 2700 will be stored in DB as 270000
     */
    private function assertCashLoanDetails(int $amount): void
    {
        $client = Client::with('products')->find($this->client->id);
        self::assertCount(1, $client->products);
        self::assertEquals($amount, $client->products->first()->cash_loan_amount);
        self::assertEquals(ProductTypeEnum::CASH_LOAN->value, $client->products->first()->type);
    }

    private function createProduct(): Product
    {
        return Product::factory()->create([
            'cash_loan_amount' => 270000,
            'type' => 'CASH_LOAN',
            'client_id' => $this->client->id,
            'adviser_id' => $this->adviser->id,
        ]);
    }
}
