<?php

namespace App\Services;

use App\Http\Validators\SubCategoryValidator;
use App\Models\SubCategory;
use App\Repositories\SubCategoryRepository;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use InvalidArgumentException;

class SubCategoryService
{
    /**
     * Repository of this service
     * @var SubCategoryRepository
     */
    protected SubCategoryRepository $subCategoryRepository;

    /**
     * SubCategoryService constructor.
     * @param SubCategoryRepository $subCategoryRepository
     */
    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->subCategoryRepository->getAll();
    }

    /**
     * @param Request $request
     * @return SubCategory
     */
    public function saveData(Request $request): SubCategory
    {
        $validator = SubCategoryValidator::validate($request->all());
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors());
        }

        return $this->subCategoryRepository->save($request);
    }
}
