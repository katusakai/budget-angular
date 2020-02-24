<?php

use Illuminate\Database\Seeder;
use App\User;

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
        $newUser->name            = env('ADMIN_NAME');
        $newUser->email           = env('ADMIN_EMAIL');
        $newUser->password        = bcrypt(env('ADMIN_PASSWORD'));
        $newUser->assignRole('Super Admin');
        $newUser->save();

    }
}
