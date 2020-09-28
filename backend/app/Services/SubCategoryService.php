<?php

namespace App\Services;

use App\Repositories\SubCategoryRepository;
use Illuminate\Support\Collection;

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
}
