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
        // User::factory(10)->create();

        User::factory()->create([
            'nickname' => 'arvinlp',
            'first_name' => 'Arvin',
            'last_name' => 'Loripour',
            'mobile' => 9373678851,
            'email' => 'info@arvinlp.ir',
            'password' => bcrypt('12345678'),
        ]);
    }
}
