<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->hasSetting()
            ->count(10)
            ->create();

        $user = User::factory()
            ->create([
                'name' => 'Lauro Guedes',
                'email' => 'me@user.com',
            ]);

        $user->setting()->create();
    }
}
