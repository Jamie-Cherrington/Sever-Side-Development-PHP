<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "admin_Cherrington",
            'email' => "admin@laraveljobs-app.com",
            'password' => Hash::make('superuser1234'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => "Jamie_8259",
            'email' => "Cherrington-J@ulster.ac.uk",
            'password' => Hash::make('password1234'),
            'email_verified_at' => now(),
        ]);
       


        User::factory()->count(8)->create();
        // Vacancy::factory()->count(10)->create();    maybe use this too to seed the vacancies table
    }
}
