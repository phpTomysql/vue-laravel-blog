<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,50) as $index) {
	        DB::table('posts')->insert([
                'user_id'=>rand(1,10),
                'category_id'=>rand(1,2),
                'slug'=>$faker->slug,
                'title'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
                'subtitle'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
                'meta_desc'=>$faker->paragraph($nbSentences = 3, $variableNbSentences = true),
	            'post_body' => $faker->text($maxNbChars = 500),
                'image_large' => $faker->imageUrl($width = 1600, $height = 480),
                'image_medium'=> $faker->imageUrl($width = 800, $height = 380),
                'image_thumbnail'=>$faker->imageUrl($width = 500, $height = 325)
	        ]);
	    }
    }
}
