<?php

namespace Database\Seeders;

use Artisan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ConfigurationTableSeeder::class);
        $this->call(RolesPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        Artisan::call('passport:install');
    }
}
