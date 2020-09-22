<?php

namespace Database\Seeders;

use Database\Seeders\Fake\FakeCategoriesSeeder;
use Database\Seeders\Fake\FakeMoneyFlowsTableSeeder;
use Database\Seeders\Fake\FakeUsersSeeder;
use Illuminate\Database\Seeder;

class FakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FakeUsersSeeder::class);
        $this->call(FakeCategoriesSeeder::class);
        $this->call(FakeMoneyFlowsTableSeeder::class);
    }
}
