<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $faker = Faker::create();
        // foreach (range(1, 100) as $index) {
        //     DB::table('users')->insert([
        //         'name' => $faker->name(),
        //         'email' => $faker->unique()->safeEmail(),
        //         'password' => Hash::make('123456789'),
        //         'utype' => 'C',
        //         'created_at' => $faker->dateTimeBetween('-6 month', '+1 month')
        //     ]);
        // }

        // \App\Models\Food::factory(22)->create();
        \App\Models\User::factory(1)->create();
        \App\Models\Category::factory(6)->create();
    }
}
