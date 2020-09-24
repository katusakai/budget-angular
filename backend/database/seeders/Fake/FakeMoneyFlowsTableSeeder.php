<?php

namespace Database\Seeders\Fake;

use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;
use App\Models\MoneyFlow;
use App\Services\RandomDate;
use Illuminate\Support\Facades\DB;

class FakeMoneyFlowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MoneyFlow::factory(500)->create();

        $adminUser = User::where('email', '=', env('ADMIN_EMAIL'))->first();
        MoneyFlow::factory(['user_id' => $adminUser->id])->count(200)->create();
    }

}
