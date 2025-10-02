<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Debug seeder to check database state
        $this->call(DebugSeeder::class);

        // Regular seeders
        $this->call([
            DoctorSeeder::class,
            ServiceSeeder::class,
            ArticleSeeder::class,
        ]);
    }
}
