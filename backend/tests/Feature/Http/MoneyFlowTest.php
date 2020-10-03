<?php

namespace Tests\Feature\Http;

use App\Models\Category;
use App\Models\MoneyFlow;
use App\Models\SubCategory;
use App\Models\User;
use Tests\TestCase;

class MoneyFlowTest extends TestCase
{
    public function testIndex(): void
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $subCategory = SubCategory::factory(['category_id' => $category['id']])->create();
        $date = new \DateTime();
        $data = [
            'user_id' => $user['id'],
            'sub_category_id' => $subCategory['id'],
            'created_at' => $date
        ];
        $moneyFlow = MoneyFlow::factory($data)->create();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', "/api/money/{$user['id']}/{$date->format('Y-m')}");

        try {
            $responseData = $response->json('data')[0];
            $responseDate = new \DateTime($responseData['created_at']);

            $response->assertStatus(200);
            $this->assertTrue($responseData['id'] === $moneyFlow['id']);
            $this->assertTrue($responseData['user_id'] === $moneyFlow['user_id']);
            $this->assertTrue($responseData['amount'] === $moneyFlow['amount']);
            $this->assertTrue($responseDate->format('Y-m') === $moneyFlow['created_at']->format('Y-m'));
            $this->assertTrue($responseData['description'] === $moneyFlow['description']);
            $this->assertTrue($responseData['sub_category_name'] === $subCategory['name']);
            $this->assertTrue($responseData['category_name'] === $category['name']);
        } finally {
            $moneyFlow->forceDelete();
            $subCategory->forceDelete();
            $category->forceDelete();
            $user->forceDelete();
        }
    }

    public function testStore()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $subCategory = SubCategory::factory(['category_id' => $category['id']])->create();
        $data = [
          'sub_category_id' => $subCategory['id'],
          'amount' => rand(-100, 100),
          'description' => 'test description'
        ];

        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('POST', "/api/money/", $data);

            $responseData = $response->json('data');
            $response->assertStatus(201);
            $this->assertTrue($responseData['user_id'] === $user['id']);
            $this->assertTrue($responseData['sub_category_id'] === $data['sub_category_id']);
            $this->assertTrue($responseData['amount'] === $data['amount']);
            $this->assertTrue($responseData['description'] === $data['description']);

        } finally {
            $money = MoneyFlow::whereSubCategoryId($subCategory['id'])->first();
            $money->forceDelete();
            $subCategory->forceDelete();
            $category->forceDelete();
            $user->forceDelete();
        }
    }

    public function testStoreFail()
    {
        $user = User::factory()->create();
        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('POST', "/api/money/");

            $responseError = $response->json('error');
            $response->assertStatus(400);
            $this->assertArrayHasKey('sub_category_id', $responseError);
            $this->assertArrayHasKey('amount', $responseError);
        } finally {
            $user->forceDelete();
        }
    }
}