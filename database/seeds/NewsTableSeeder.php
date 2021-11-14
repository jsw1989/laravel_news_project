<?php

use Illuminate\Database\Seeder;
use App\News;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 15; $i++) {
            News::create([
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'is_published' => $faker->boolean($i%2 == 0),
            ]);
        }
    }
}
