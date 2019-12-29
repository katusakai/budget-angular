<?php

use Illuminate\Database\Seeder;
use App\User;
//use Faker\Generator as Faker;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newUser                  = new User();
        $newUser->name            = 'Admin';
        $newUser->email           = 'admin@admin.com';
        $newUser->password        = bcrypt('password');
        $newUser->api_token       = 'ESIjnjnz2Nva69esqatI35Q0S7K5GvC5HAyY0ktlgYszIPFmDfPPHSz7wOqTUHZGU2GuIhORlBGAs7xj';
        $newUser->save();

        $newUser                  = new User();
        $newUser->name            = 'Tadas Janca';
        $newUser->email           = 'tadasjanca@gmail.com';
        $newUser->password        = bcrypt('password');
        $newUser->api_token       = Str::random(80);
        $newUser->save();

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $newUser                  = new User();
            $newUser->name            = $faker->name . ' ' . $faker->lastName;
            $newUser->email           = $faker->email;
            $newUser->password        = bcrypt('password');
            $newUser->api_token       = Str::random(80);
            $newUser->save();
        }
    }
}
