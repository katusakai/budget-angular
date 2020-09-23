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

    protected $subCategories;

    protected $randomDate;

    /**
     * FakeMoneyFlowsTableSeeder constructor.
     * @param RandomDate $randomDate
     */
    public function __construct(RandomDate $randomDate)
    {
        $this->subCategories = DB::table('sub_categories')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->select('sub_categories.id AS sub_category_id', 'categories.name AS category_name')
            ->get()->toArray();

        $this->randomDate = $randomDate;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = User::all()->pluck('id')->toArray();
        for ($i = 0; $i < 500; $i++) {
            $userId = $userIds[array_rand($userIds)];
            $this->seed($userId);
        }

        $adminUser = User::where('email', '=', env('ADMIN_EMAIL'))->first();
        for ($i = 0; $i < 200; $i++)
        {
            $this->seed($adminUser->id);
        }
    }

    protected function seed($userId)
    {
        $randomSubcategory = $this->subCategories[array_rand($this->subCategories)];
        $money = new MoneyFlow();
        $money->user_id = $userId;
        $money->sub_category_id = $randomSubcategory->sub_category_id;
        $randomSubcategory->category_name === 'Income' ? $multiplier = 10 : $multiplier = -1;
        $money->amount = $multiplier * rand(100, 50000)/100;
        $money->created_at = new DateTime();
        $money->save();
    }
}
