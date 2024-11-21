<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Thread;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Thread::factory(20)->create();
        User::factory(50)->create();

        User::factory()->create([
            'name' => 'Nur Akyol',
            'email' => 'nazlinurakyol@yahoo.com',
            'password' => '1234',
        ]);
    }
}
