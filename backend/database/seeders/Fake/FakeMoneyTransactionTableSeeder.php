<?php

namespace Database\Seeders\Fake;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\MoneyTransaction;

class FakeMoneyTransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MoneyTransaction::factory(500)->create();

        $adminUser = User::where('email', '=', env('ADMIN_EMAIL'))->first();
        MoneyTransaction::factory(['user_id' => $adminUser->id])->count(200)->create();
    }
}
