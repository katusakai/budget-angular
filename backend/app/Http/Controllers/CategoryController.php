<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Validators\CategoryValidator;
use App\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $search = request()['search'] && request()['search'] !== '' ? request()['search'] : '%';

        $categories = DB::table('categories')
            ->select('categories.id', 'categories.name')
            ->where('categories.name', 'like', "%{$search}%")
            ->where('categories.deleted', 0)
            ->orderBy('categories.name')
            ->get();
        return $this->sendResponse($categories, '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = CategoryValidator::validate($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $oldCategory = Category::where('name', $request->name)->first();
        if ($oldCategory)
        {
            $category = $oldCategory;
            $category->deleted = 0;
            $category->save();
        } else
        {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
        }

        return $this->sendResponse($category, 'Category was created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category)
            return $this->sendError('Category not found');

        return $this->sendResponse($category, 'Category was founded');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        if (!$category)
            return $this->sendError('Category not found');

        if ($category->name === $request->name)
            return $this->sendResponse($category, 'Category name did not change');

        $validator = CategoryValidator::validate($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $category->name = $request->name;
        $category->save();

        return $this->sendResponse($category, 'Category was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if ($category === null)
            return $this->sendError('Category not found');

        $subcategories = SubCategory::where('category_id', $category->id)->get();
        if (count($subcategories))
            return $this->sendError('Cannot delete category, because it has subcategories','',403);

        $category->deleted = 1;
        $category->save();
        return $this->sendResponse($category, 'Category was deleted');
    }
}
