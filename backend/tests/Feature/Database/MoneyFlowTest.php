<?php

namespace Tests\Feature\Database;

use App\Models\Category;
use App\Models\MoneyFlow;
use App\Models\SubCategory;
use App\Models\User;
use Tests\TestCase;

class MoneyFlowTest extends TestCase implements TableTestInterface
{
    /**
     * Name of database table of tested model
     * @var string
     */
    protected string $table = 'money_flows';

    /**
     * Table fields existence test.
     *
     * @return void
     */
    public function testExists(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $subCategory = SubCategory::factory([
            'category_id' => $category['id']
        ])->create();

        $data = [
            'user_id' => $user['id'],
            'sub_category_id' => $subCategory['id']
        ];

        MoneyFlow::factory()->create($data);
        $this->assertDatabaseHas('money_flows', $data);
        $user->forceDelete();
        $category->forceDelete();
    }

    /**
     * Table records delete test.
     *
     * @return void
     */
    public function testDeleted(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $subCategory = SubCategory::factory([
            'category_id' => $category['id']
        ])->create();

        $data = [
            'user_id' => $user['id'],
            'sub_category_id' => $subCategory['id']
        ];
        $money = MoneyFlow::factory()->create($data);
        $this->assertDatabaseHas('money_flows', $data);
        $money->delete();
        $this->assertSoftDeleted('money_flows', $data);
        $money->forceDelete();
        $this->assertDeleted('money_flows', $data);

        $user->forceDelete();
        $category->forceDelete();
    }
}