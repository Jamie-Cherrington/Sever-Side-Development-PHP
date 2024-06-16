<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use App\Models\Vacancy;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Matcher\Not;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

      //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            UserSeeder::class,
            VacancySeeder::class, //this the faker one 
            VacancySeederJSON::class,
            CommentsSeeder::class,
            CategorySeederJSON::class,
            CategoryVacancySeeder::class,
            UserSeederUpdateRole::class,
           
        ]);
        //supposed to only apply to a single connection and reset it's self
        //but i like to explicitly undo what i've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

  
    }
}
