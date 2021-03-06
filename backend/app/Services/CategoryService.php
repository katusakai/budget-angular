<?php

namespace App\Services;

use App\Http\Validators\CategoryValidator;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Throwable;

class CategoryService
{
    /**
     * Repository of this service
     * @var CategoryRepository
     */
    protected CategoryRepository $categoryRepository;

    /**
     * Model validator
     * @var CategoryValidator
     */
    protected CategoryValidator $categoryValidator;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     * @param CategoryValidator $categoryValidator
     */
    public function __construct(CategoryRepository $categoryRepository, CategoryValidator $categoryValidator)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryValidator = $categoryValidator;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * @return Collection
     */
    public function getForUser(): Collection
    {
        return $this->categoryRepository->getForUser();
    }

    /**
     * @param Request $request
     * @return Category
     */
    public function saveData(Request $request): Category
    {
        $validator = $this->categoryValidator->store($request->all());
        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        return $this->categoryRepository->save($request);
    }

    /**
     * @param int $id
     * @return Category
     * @throws Exception
     */
    public function getById(int $id): Category
    {
        try {
            $category = $this->categoryRepository->getById($id);
        } catch (Exception $error) {
            throw new Exception();
        }

        return $category;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Category
     * @throws Throwable
     */
    public function updateData(Request $request, int $id): Category
    {
        $category = Category::find($id);
        if (!$category) {
            throw new Exception('Category was not found',404);
        }
        if ($category->name === $request['name']) {
            throw new Exception('Category name did not change',400);
        }

        $validator = $this->categoryValidator->update($request->all());
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $category = $this->categoryRepository->update($request, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update category data');
        }

        DB::commit();;

        return $category;
    }

    /**
     * @param int $id
     * @return Category
     * @throws Exception|Throwable
     */
    public function deleteById(int $id): Category
    {
        $category = Category::find($id);
        if (!$category) {
            throw new Exception('Category was not found',404);
        }

        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete category data');
        }

        DB::commit();
        return $category;
    }
}
