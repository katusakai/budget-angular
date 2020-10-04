<?php

namespace Tests\Feature\Database;

use App\Models\Category;
use App\Models\MoneyTransaction;
use App\Models\SubCategory;
use App\Models\User;
use Tests\TestCase;
use Exception;

class SubCategoryTest extends TestCase implements TableTestInterface
{
    /**
     * Name of database table of tested model
     * @var string
     */
    protected string $table = 'sub_category';

    /**
     * Table fields existence test.
     *
     * @return void
     * @throws Exception
     */
    public function testExists(): void
    {
        $category = Category::factory()->create();
        $data = ['category_id' => $category['id']];
        $subCategory = SubCategory::factory($data)->create();
        $this->assertDatabaseHas($this->table, $data);
        $subCategory->forceDelete();
        $category->forceDelete();
    }

    /**
     * Table records delete test.
     *
     * @return void
     * @throws Exception
     */
    public function testDeleted(): void
    {
        $category = Category::factory()->create();
        $data = ['category_id' => $category['id']];
        $subCategory = SubCategory::factory($data)->create();
        $this->assertDatabaseHas($this->table, $data);

        $subCategory->delete();
        $this->assertSoftDeleted($this->table, $data);
        $subCategory->forceDelete();
        $this->assertDeleted($this->table, $data);
        $category->forceDelete();
    }

    /**
     * Child table records delete test.
     *
     * @return void
     * @throws Exception
     */
    public function testChildDeleted(): void
    {
        $category = Category::factory()->create();
        $subCategory = SubCategory::factory(['category_id' => $category['id']])->create();
        $user = User::factory()->create();
        $data = [
            'user_id' => $user['id'],
            'sub_category_id' => $subCategory['id']
        ];
        MoneyTransaction::factory($data)->create();
        $this->assertDatabaseHas('money_transaction', $data);

        $subCategory->delete();
        $this->assertSoftDeleted('money_transaction', $data);
        $subCategory->forceDelete();
        $this->assertDeleted('money_transaction', $data);

        $user->forceDelete();
        $category->forceDelete();
    }

}
