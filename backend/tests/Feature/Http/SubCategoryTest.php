<?php

namespace Tests\Feature\Http;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Tests\TestCase;

class SubCategoryTest extends TestCase
{
    public function testIndex(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $subCategory = SubCategory::factory(['category_id' => $category['id']])->create();

        $subCategoryArray = [
            'id' => $subCategory['id'],
            'name' => $subCategory['name'],
            'category_name' => $category['name']
        ];

        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('GET', "/api/subcategory");

            $responseData = $response->json('data');
            $response->assertStatus(200);
            $this->assertTrue(in_array($subCategoryArray, $responseData));

            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('GET', "/api/subcategory?search={$subCategory['name']}");

            $responseData = $response->json('data');
            $response->assertStatus(200);
            $this->assertTrue(in_array($subCategoryArray, $responseData));

        } finally {
            $subCategory->forceDelete();
            $category->forceDelete();
            $user->forceDelete();
        }
    }
}
