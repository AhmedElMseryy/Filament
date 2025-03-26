<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\About;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        About::query()->create([
            "name" => [
                "en" => $faker->name,
                "ar" => $faker->name,
            ],
            "description" => [
                "en" => $faker->text,
                "ar" => $faker->text,
            ],
            "meta_title" => [
                "en" => $faker->sentence,
                "ar" => $faker->sentence,
            ],
            "meta_description" => [
                "en" => $faker->text,
                "ar" => $faker->text,
            ],
            "type" => "about"
        ]);
    }
}
