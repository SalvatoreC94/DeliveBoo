<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

//Models
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function () {
            User::truncate();
        });

        for ($i = 0; $i < 10; $i++) {

            User::create([
                'name' => fake()->userName(),
                'email' => fake()->safeEmail(),
                'password' => bcrypt('password'),
            ]);
        }
    }
}
