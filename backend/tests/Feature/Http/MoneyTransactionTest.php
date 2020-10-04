<?php

namespace Tests\Feature\Http;

use App\Models\Category;
use App\Models\MoneyTransaction;
use App\Models\SubCategory;
use App\Models\User;
use Tests\TestCase;

class MoneyTransactionTest extends TestCase
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
        $moneyTransaction = MoneyTransaction::factory($data)->create();

        $response = $this->actingAs($user, 'api')
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', "/api/money/{$user['id']}/{$date->format('Y-m')}");

        try {
            $responseData = $response->json('data')[0];
            $responseDate = new \DateTime($responseData['created_at']);

            $response->assertStatus(200);
            $this->assertTrue($responseData['id'] === $moneyTransaction['id']);
            $this->assertTrue($responseData['user_id'] === $moneyTransaction['user_id']);
            $this->assertTrue($responseData['amount'] === $moneyTransaction['amount']);
            $this->assertTrue($responseDate->format('Y-m') === $moneyTransaction['created_at']->format('Y-m'));
            $this->assertTrue($responseData['description'] === $moneyTransaction['description']);
            $this->assertTrue($responseData['sub_category_name'] === $subCategory['name']);
            $this->assertTrue($responseData['category_name'] === $category['name']);
        } finally {
            $moneyTransaction->forceDelete();
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
            $money = MoneyTransaction::whereSubCategoryId($subCategory['id'])->first();
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

    public function testUpdate()
    {
        $category = Category::factory()->create();
        $user = User::factory()->create();
        $subCategory = SubCategory::factory(['category_id' => $category['id']])->create();
        $money = MoneyTransaction::factory([
            'user_id' => $user['id'],
            'sub_category_id' => $subCategory['id']
        ])->create();
        $data = [
            'sub_category_id' => $subCategory['id'],
            'amount' => rand(-100, 100),
            'description' => 'test description'
        ];

        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('PUT', "/api/money/{$money['id']}", $data);
            $responseData = $response->json('data');
            $this->assertTrue($responseData['user_id'] === $user['id']);
            $this->assertTrue($responseData['sub_category_id'] === $data['sub_category_id']);
            $this->assertTrue($responseData['amount'] === $data['amount']);
            $this->assertTrue($responseData['description'] === $data['description']);
            $response->assertStatus(200);

        } finally {
            $money->forceDelete();
            $subCategory->forceDelete();
            $category->forceDelete();
            $user->forceDelete();
        }
    }

    public function testUpdateFail()
    {
        $user = User::factory()->create();
        $money = MoneyTransaction::factory()->create();
        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('PUT', "/api/money/{$money['id']}", []);

            $responseError = $response->json('error');
            $response->assertStatus(400);
            $this->assertArrayHasKey('sub_category_id', $responseError);
            $this->assertArrayHasKey('amount', $responseError);
        } finally {
            $user->forceDelete();
            $money->forceDelete();
        }
    }

    public function testDestroy()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create();
        $subCategory = SubCategory::factory(['category_id' => $category['id']])->create();
        $money = MoneyTransaction::factory([
            'user_id' => $user['id'],
            'sub_category_id' => $subCategory['id']
        ])->create();
        try {
            $response = $this->actingAs($user, 'api')
                ->withHeaders(['Accept' => 'application/json'])
                ->json('DELETE', "/api/money/{$money['id']}");

            $responseData = $response->json('data');
            $response->assertStatus(200);
            $this->assertTrue($responseData['user_id'] === $user['id']);
            $this->assertTrue($responseData['sub_category_id'] === $subCategory['id']);
            $this->assertTrue($responseData['amount'] === $money['amount']);
            $this->assertTrue($responseData['description'] === $money['description']);
            $this->assertTrue($response->json('success'));

        } finally {
            $money->forceDelete();
            $subCategory->forceDelete();
            $category->forceDelete();
            $user->forceDelete();
        }
    }
}
