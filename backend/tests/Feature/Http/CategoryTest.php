<?php

namespace Tests\Feature\Http;

use App\Models\Category;
use App\Models\User;
use Tests\Feature\AdminUser;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use AdminUser;

    public function testIndex(): void
    {
        $category = Category::factory()->create();
        $response = $this->actingAs($this->adminUser, 'api')
                    ->withHeaders(['Accept' => 'application/json'])
                    ->json('GET', '/api/admin/category');
        $response->assertStatus(200);
        $category->forceDelete();
    }

    public function testIndexLimit(): void
    {
        $categories = Category::factory()->count(2)->create();
        $limit = 2;
        $response = $this->actingAs($this->adminUser, 'api')
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', '/api/admin/category', ['limit' => $limit]);
        $response->assertStatus(200);
        $this->assertTrue(count($response->json('data')['data']) === $limit);

        $categories->each(function ($category) {
           $category->forceDelete();
        });
    }

    public function testIndexSearch(): void
    {
        $name = 'TestCategoryName';
        $category = Category::factory(['name' => $name])->create();
        $response = $this->actingAs($this->adminUser, 'api')
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', '/api/admin/category', ['search' => $name]);
        $response->assertStatus(200);

        $this->assertTrue($response->json('data')['data'][0]['name'] === $name);
        $category->forceDelete();
    }

    public function testGet()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $categoryArray = [
            'id' => $category['id'],
            'name' => $category['name']
        ];
        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', '/api/category');

        try {
            $responseData = $response->json('data');
            $response->assertStatus(200);
            $this->assertTrue(in_array($categoryArray, $responseData));
        } finally {
            $category->forceDelete();
            $user->forceDelete();
        }
    }
}
