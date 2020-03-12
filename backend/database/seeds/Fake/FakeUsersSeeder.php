<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 300;
        $faker = Faker::create();

        foreach (range(0, $count) as $i) {
            $user = new User();
            $user->name = $faker->name;
            if (!User::where('email', $faker->email)->first()) {
                $user->email = $faker->email;
            } else {
                continue;
            }
            $user->password = bcrypt('password');
            $user->save();
        }
    }
}
