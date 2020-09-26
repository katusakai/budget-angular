<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\MoneyFlow;
use App\Models\SubCategory;
use App\Models\User;
use App\Services\RandomDate;
use Illuminate\Database\Eloquent\Factories\Factory;

class MoneyFlowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MoneyFlow::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::all()->random(1)->first();
        $sub_category = SubCategory::all()->random(1)->first();
        $category = Category::find($sub_category->category_id);
        $multiplier = $category->name === 'Income' ? 10 : -1;
        $randomDate = new RandomDate();

        return [
            'user_id' => $user->id,
            'sub_category_id' => $sub_category->id,
            'amount' => $multiplier * rand(100, 50000)/100,
            'created_at' => $randomDate->daysBefore(30)
        ];
    }
}
