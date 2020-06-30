<?php

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
