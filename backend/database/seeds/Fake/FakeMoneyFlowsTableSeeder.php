<?php

use App\User;
use Illuminate\Database\Seeder;
use App\MoneyFlow;
use App\Services\RandomDate;
use Illuminate\Support\Facades\DB;

class FakeMoneyFlowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param RandomDate $randomDate
     * @return void
     */
    public function run(RandomDate $randomDate)
    {
        $userIds = User::all()->pluck('id')->toArray();
        $subCategories = DB::table('sub_categories')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->select('sub_categories.id AS sub_category_id', 'categories.name AS category_name')
            ->get()->toArray();
        for ($i = 0; $i < 500; $i++) {
            $randomSubcategory = $subCategories[array_rand($subCategories)];

            $money = new MoneyFlow();
            $money->user_id = $userIds[array_rand($userIds)];
            $money->sub_category_id = $randomSubcategory->sub_category_id;
            $randomSubcategory->category_name === 'Income' ? $multiplier = 10 : $multiplier = -1;
            $money->amount = encrypt($multiplier * rand(100, 50000)/100);
            $money->created_at = $randomDate->daysBefore(365);
            $money->save();
        }
    }
}
