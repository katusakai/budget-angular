<?php

namespace Database\Seeders\Fake;

use App\Services\InitialCategoriesList;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;

class FakeCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param InitialCategoriesList $initialCategoriesList
     * @return void
     */
    public function run(InitialCategoriesList $initialCategoriesList)
    {
        foreach ($initialCategoriesList->get() as $category) {
            if (Category::where('name', '=', $category->Category)->first()) {
                continue;
            }

            $newCategory = Category::factory(['name' => $category->Category])->create()->first();
            foreach ($category->Subcategories as $subCategory) {
                $newSubCategory = new SubCategory();
                $newSubCategory->name = $subCategory;
                $newSubCategory->category_id = $newCategory->id;
                $data = [
                    'name' => $subCategory,
                    'category_id' => $newCategory->id
                ];
                SubCategory::factory($data)->create();
            }
        }
    }
}
