<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Validators\CategoryValidator;
use App\Services\CategoryService;
use App\Models\SubCategory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    /**
     * Service for controller
     * @var CategoryService
     */
    protected CategoryService $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource for admin.
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getAll();
        if ($categories->items()) {
            $message ='A list of categories have been shown';
            return $this->sendResponse($categories, $message);
        } else {
            return $this->sendError('Data was not found', [], 404);
        }
    }

    /**
     * Display a listing of the resource for user.
     *
     * @return JsonResponse
     */
    public function get()
    {
        $categories = $this->categoryService->getForUser();

        return $this->sendResponse($categories, 'A list of categories have been shown');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $category = $this->categoryService->saveData($request);
            return $this->sendResponse($category, 'Category was created', 201);
        } catch (Exception $e) {
            return $this->sendError('Validation Error.', json_decode($e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $category = $this->categoryService->specific($id);
            return $this->sendResponse($category, 'Category was found');
        } catch (Exception $e) {
            return $this->sendError('Category was not found');
        }
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
