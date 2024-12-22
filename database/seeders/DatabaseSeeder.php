<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'role' => 'admin',
            'no_tlp' => '081212347865',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);

        $this->call([
            KriteriaSeeder::class,
        ]);
    }
}
