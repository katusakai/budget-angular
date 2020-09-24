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
     * User owning this model
     * @var User
     */
    protected User $user;

    /**
     * Subcategory owning this model
     * @var SubCategory
     */
    protected SubCategory $sub_category;

    /**
     * Category owning subcategory which owns this model
     * @var Category
     */
    protected Category $category;

    /**
     * This model amount is multiplied by this value according to category
     * @var int
     */
    protected int $multiplier;

    /**
     * Random date
     * @var RandomDate
     */
    protected RandomDate $randomDate;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MoneyFlow::class;

    /**
     * MoneyFlowFactory constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = User::all()->random(1)->first();
        $this->sub_category = SubCategory::all()->random(1)->first();
        $this->category = Category::find($this->sub_category->category_id);
        $this->multiplier = $this->category->name === 'Income' ? 10 : -1;
        $this->randomDate = new RandomDate();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->user->id,
            'sub_category_id' => $this->sub_category->id,
            'amount' => $this->multiplier * rand(100, 50000)/100,
            'created_at' => $this->randomDate->daysBefore(30)
        ];
    }
}
