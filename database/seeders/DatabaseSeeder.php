<?php

namespace Database\Seeders;

use App\Models\Adviser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Product::truncate();
        Adviser::truncate();
        Client::truncate();

        Schema::enableForeignKeyConstraints();

        $this->call([
            AdviserSeeder::class,
            ClientSeeder::class,
        ]);
    }
}
