<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CategorySeederJSON extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $json = File::get("database/data/categories.json");

        $category = json_decode($json);

        foreach ($category as $key => $value) {
            Category::create([
                "id" => $value->id,
                "topic" => $value->topic,
                "created_at" => $value->created_at,
                "updated_at" => $value->updated_at,
            ]
            );
            $this->command->info($value->topic.' seeded');
        }
    }
}
