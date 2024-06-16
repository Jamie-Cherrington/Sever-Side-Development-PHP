<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class VacancySeederJSON extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vacancy::truncate();

        $json = File::get("database/data/vacancies.json");

        $vacancy = json_decode($json);
        $vacancy_id = 1;
        foreach ($vacancy as $key => $value) {
            Vacancy::create([
                "user_id" => $value->user_id,
                "title" => $value->title,
                "body" => $value->body,
                "time_to_read" => $value->time_to_read,
                "is_published" => $value->is_published,
                "priority" => $value->priority,
            ]
            );
            $this->command->info($vacancy_id.' seeded and allocated to User: '.$value->user_id);
            $vacancy_id++;
        }
    }
}
