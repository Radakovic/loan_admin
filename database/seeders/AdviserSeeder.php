<?php

namespace Database\Seeders;

use App\Models\Adviser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adviser::factory(4)->create();
        Adviser::factory()->create(function (): array {
            return [
                'email' => 'adviser@example.com',
            ];
        });
    }
}
