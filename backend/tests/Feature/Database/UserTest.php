<?php

namespace Tests\Feature\Database;

use App\Models\Category;
use App\Models\MoneyFlow;
use App\Models\SubCategory;
use App\Models\User;
use Exception;
use Tests\TestCase;

class UserTest extends TestCase implements TableTestInterface
{
    /**
     * Name of database table of tested model
     * @var string
     */
    protected string $table = 'users';

    /**
     * Table fields existence test.
     *
     * @return void
     * @throws Exception
     */
    public function testExists(): void
    {
        $data = [
            'name' => 'testName',
            'email' => 'testemail@email.com'
        ];
        $user = User::factory($data)->create();
        $this->assertDatabaseHas($this->table, $data);
        $user->forceDelete();
    }

    /**
     * Table records delete test.
     *
     * @return void
     * @throws Exception
     */
    public function testDeleted(): void
    {
        $user = User::factory()->create();

        if ($user) {
            $user->delete();
            $this->assertSoftDeleted($this->table, ['id' => $user['id']]);

            $user->forceDelete();
            $this->assertDeleted($this->table, ['id' => $user['id']]);

        } else {
            $this->assertTrue('false');
        }
    }

    /**
     * Child table records delete test.
     *
     * @return void
     * @throws Exception
     */
    public function testChildDeleted(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $subCategory = SubCategory::factory([
            'category_id' => $category['id']
        ])->create();

        if ($user && $subCategory) {
            $data = [
                'user_id' => $user['id'],
                'sub_category_id' => $subCategory['id']
            ];
            MoneyFlow::factory()->create($data);

            $this->assertDatabaseHas('money_flows', $data);
            $user->delete();
            $this->assertSoftDeleted('money_flows', $data);
            $user->forceDelete();
            $this->assertDeleted('money_flows', $data);

            $category->forceDelete();
            $subCategory->forceDelete();

        } else {
            $this->assertTrue('false');
        }
    }
}
