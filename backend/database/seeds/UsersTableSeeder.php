<?php

use Illuminate\Database\Seeder;
use App\User;
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
        $newUser->save();

        $newUser                  = new User();
        $newUser->name            = 'Tadas Janca';
        $newUser->email           = 'tadasjanca@gmail.com';
        $newUser->password        = bcrypt('password');
        $newUser->save();

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            $newUser                  = new User();
            $newUser->name            = $faker->name . ' ' . $faker->lastName;
            $newUser->email           = $faker->email;
            $newUser->password        = bcrypt('password');
            $newUser->save();
        }
    }
}
