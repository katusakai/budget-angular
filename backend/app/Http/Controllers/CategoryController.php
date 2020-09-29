<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

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
            $category = $this->categoryService->getById($id);
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
     * @throws Throwable
     */
    public function update(Request $request, int $id)
    {
        try {
            $category = $this->categoryService->updateData($request, $id);
            return $this->sendResponse($category, 'Category was updated');
        } catch (Exception $e) {
            if ($e->getCode() !== 0) {
                return $this->sendError($e->getMessage(), [], $e->getCode());
            }
            return $this->sendError('Errors occurred.', json_decode($e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function destroy(int $id)
    {
        try {
            $category = $this->categoryService->deleteById($id);
            return $this->sendResponse($category, 'Category was deleted');
        } catch (Exception $e) {
            if ($e->getCode() !== 0) {
                return $this->sendError($e->getMessage(), [], $e->getCode());
            }
            return $this->sendError('Errors occurred.', json_decode($e->getMessage()));
        }
    }
}
