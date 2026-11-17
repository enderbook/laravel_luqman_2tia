<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = \Faker\Factory::create();
        $faker = Faker::create('ar_SA');

        foreach (range(1, 100) as $index) {
            DB::table('users')->insert([
                'name' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('gatotkaca')
            ]);
        }
    }
}
