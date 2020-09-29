<?php

namespace App\Services;

use App\Http\Validators\CategoryValidator;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Exception;
use InvalidArgumentException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryService
{
    /**
     * Repository of this service
     * @var CategoryRepository
     */
    protected CategoryRepository $categoryRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
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
        $validator = CategoryValidator::validate($request->all());
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors());
        }

        return $this->categoryRepository->save($request);
    }

    /**
     * @param int $id
     * @return Category
     * @throws Exception
     */
    public function specific(int $id): Category
    {
        try {
            $category = $this->categoryRepository->getSpecific($id);
        } catch (Exception $error) {
            throw new Exception();
        }

        return $category;
    }

}
