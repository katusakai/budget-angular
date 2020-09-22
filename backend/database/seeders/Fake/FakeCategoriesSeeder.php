<?php

namespace Database\Seeders\Fake;

use App\Services\InitialCategoriesList;
use Illuminate\Database\Seeder;
use App\Category;
use App\SubCategory;

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
            $newCategory = new Category();
            $newCategory->name = $category->Category;
            $newCategory->save();
            foreach ($category->Subcategories as $subCategory) {
                $newSubCategory = new SubCategory();
                $newSubCategory->name = $subCategory;
                $newSubCategory->category_id = $newCategory->id;
                $newSubCategory->save();
            }
        }
    }
}
