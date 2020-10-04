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
     * Model validator
     * @var SubCategoryValidator
     */
    protected SubCategoryValidator $subCategoryValidator;

    /**
     * SubCategoryService constructor.
     * @param SubCategoryRepository $subCategoryRepository
     * @param SubCategoryValidator $subCategoryValidator
     */
    public function __construct(SubCategoryRepository $subCategoryRepository, SubCategoryValidator $subCategoryValidator)
    {
        $this->subCategoryRepository = $subCategoryRepository;
        $this->subCategoryValidator = $subCategoryValidator;
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
        $validator = $this->subCategoryValidator->store($request->all());
        if($validator->fails()){
            throw new InvalidArgumentException($validator->errors());
        }

        return $this->subCategoryRepository->save($request);
    }
}
