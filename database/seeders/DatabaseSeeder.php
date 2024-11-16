<?php

namespace Database\Seeders;

use App\Models\Adviser;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdviserSeeder::class,
            ClientSeeder::class,
        ]);
    }
}
