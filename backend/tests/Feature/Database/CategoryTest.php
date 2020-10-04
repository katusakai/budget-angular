<?php

namespace Tests\Feature\Database;

use App\Models\Category;
use App\Models\SubCategory;
use Tests\TestCase;

class CategoryTest extends TestCase implements TableTestInterface
{
    /**
     * Name of database table of tested model
     * @var string
     */
    protected string $table = 'category';

    /**
     * Table fields existence test.
     *
     * @return void
     */
    public function testExists(): void
    {
        $data = [
            'name' => 'testName',
        ];
        $category = Category::factory($data)->create();
        $this->assertDatabaseHas($this->table, $data);
        $category->forceDelete();
    }

    /**
     * Table records delete test.
     *
     * @return void
     * @throws \Exception
     */
    public function testDeleted(): void
    {
        $data = [
            'name' => 'testName',
        ];
        $category = Category::factory($data)->create();
        $this->assertDatabaseHas($this->table, $data);

        $category->delete();
        $this->assertSoftDeleted($this->table, $data);
        $category->forceDelete();
        $this->assertDeleted($this->table, $data);
    }

    /**
     * Child table records delete test.
     *
     * @return void
     * @throws \Exception
     */
    public function testChildDeleted(): void
    {
        $category = Category::factory()->create();
        $data = [
            'category_id' => $category['id']
        ];
        SubCategory::factory($data)->create();
        $this->assertDatabaseHas('sub_category', $data);

        $category->delete();
        $this->assertSoftDeleted('sub_category', $data);
        $category->forceDelete();
        $this->assertDeleted('sub_category', $data);
    }
}
