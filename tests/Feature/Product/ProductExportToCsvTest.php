<?php

namespace Tests\Feature\Product;

use App\Models\Adviser;
use DateTimeImmutable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ProductExportToCsvTest extends TestCase
{
    use RefreshDatabase;

    private Adviser $adviser;
    protected function setUp(): void
    {
        parent::setUp();
        $this->adviser = Adviser::factory()->create();
    }
    protected function tearDown(): void
    {
        $filePath = storage_path(sprintf('report_%s.csv', (new DateTimeImmutable())->format('Y-m-d')));
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        parent::tearDown();
    }
    /**
     * Unauthenticated users will be redirected to login page
     */
    public function testUnauthenticatedRedirectToLoginPage(): void
    {
        $response = $this->get('/products/export');
        $response->assertStatus(302);
        $response->assertRedirect(route('login', absolute: false));
    }
    /**
     * Authenticated users can download CSV file
     */
    public function testAccessToProductListPage(): void
    {
        $response = $this->actingAs($this->adviser)->get('/products/export');
        $response->assertStatus(200);
    }
}
