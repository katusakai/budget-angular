<?php

namespace Tests\Feature\Database;

use App\Models\Category;
use App\Models\MoneyTransaction;
use App\Models\SubCategory;
use App\Models\User;
use Tests\TestCase;

class MoneyTransactionTest extends TestCase implements TableTestInterface
{
    /**
     * Name of database table of tested model
     * @var string
     */
    protected string $table = 'money_transaction';

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

        MoneyTransaction::factory()->create($data);
        $this->assertDatabaseHas($this->table, $data);
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
        $money = MoneyTransaction::factory()->create($data);
        $this->assertDatabaseHas($this->table, $data);
        $money->delete();
        $this->assertSoftDeleted($this->table, $data);
        $money->forceDelete();
        $this->assertDeleted($this->table, $data);

        $user->forceDelete();
        $category->forceDelete();
    }
}
