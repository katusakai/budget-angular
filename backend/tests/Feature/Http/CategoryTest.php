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

    public function testStore()
    {
        $user = User::factory()->create();
        $name = 'TestingCategoryName';
        $data = ['name' => $name];

        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('POST', '/api/category', $data);
            $responseData = $response->json('data');
            $response->assertStatus(201);
            $this->assertTrue($responseData['name'] ===  $name);

            // Test again with existing data
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('POST', '/api/category', $data);
            $response->assertStatus(404);
            $responseError = $response->json('error');
            $this->assertArrayHasKey('name', $responseError);

        } finally {
            $user->forceDelete();
            $category = Category::whereName($name)->get()[0];
            $category->forceDelete();
        }
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();

        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('GET', "/api/category/{$category['id']}");
            $responseData = $response->json('data');
            $response->assertStatus(200);
            $this->assertTrue($responseData['id'] ===  $category['id']);
            $this->assertTrue($responseData['name'] ===  $category['name']);

        } finally {
            $user->forceDelete();
            $category->forceDelete();
        }
    }

    public function testShowNonExisting()
    {
        $user = User::factory()->create();

        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('GET', '/api/category/999999999999999');
            $response->assertStatus(404);
            $this->assertTrue($response->json('success') === false);
        } finally {
            $user->forceDelete();
        }
    }

    public function testUpdate()
    {
        $newName = 'TestCategoryName';
        $category = Category::factory()->create();
        $data = ['name' => $newName];
        try {
            $response = $this->actingAs($this->adminUser, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('PUT', "/api/admin/category/{$category['id']}", $data);

            $responseData = $response->json('data');
            $response->assertStatus(200);
            $this->assertTrue($responseData['name'] === $newName);

            // Test again with same values
            $response = $this->actingAs($this->adminUser, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('PUT', "/api/admin/category/{$category['id']}", $data);
            $response->assertStatus(400);
        } finally {
            $category->forceDelete();
        }
    }

    public function testDestroy()
    {
        $category = Category::factory()->create();
        $data = ['name' => $category['name']];
        $this->assertDatabaseHas('categories', $data);

        try {
            $response = $this->actingAs($this->adminUser, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('DELETE', "/api/admin/category/{$category['id']}");
            $responseData = $response->json('data');
            $response->assertStatus(200);
            $this->assertTrue($category['name'] === $responseData['name']);

            // Call again
            $response = $this->actingAs($this->adminUser, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('DELETE', "/api/admin/category/{$category['id']}");
            $response->assertStatus(404);
        } finally {
            $category->forceDelete();
        }

    }
}
