<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1,5) as $index){
            DB::table('posts')->insert([
                'uuid' => Str::uuid(),
                'user_id'=>1,
                'image' => Str::random(8).'png',
                'product_name' => $faker->word(),
                'product_details' => $faker->paragraph(),
                'category' => $faker->word(),
                'type' => $faker->word(),
                'division' => $faker->word(),
                'district' => $faker->word(),
                'area' => $faker->word(),
                'price' => $faker->randomFloat(2, 500, 10000),
            ]);
        }

    }
}
