<?php

namespace Database\Seeders;

use App\Models\Vacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vacancy::factory()->count(10)->create();
    
        $vacancies = [
            [
                'id'=>11,
                'user_id'=>2,
                'title'=>'Made by me',
                'body'=>'This is a vacancy made by me',
                'time_to_read'=>2,
                'is_published'=>1,
                'priority'=>3,
                'created_at'=> now(),
                'updated_at'=> now()
            ]
            ];
        $chunks = array_chunk($vacancies, 50);
          foreach ($chunks as $chunk) {
              Vacancy::insert($chunk);
          }
          $this->command->info('Seeded the Vacancies!');
    }
}
