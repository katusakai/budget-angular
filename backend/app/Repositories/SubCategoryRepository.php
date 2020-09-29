<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Services\QueryParams;
use Illuminate\Support\Collection;

class SubCategoryRepository
{
    /**
     * Model of repository
     * @var SubCategory
     */
    protected SubCategory $subCategory;

    /**
     * Request query parameters list
     * @var QueryParams
     */
    protected QueryParams $queryParams;

    /**
     * SubCategoryRepository constructor.
     * @param SubCategory $subCategory
     * @param QueryParams $queryParams
     */
    public function __construct(SubCategory $subCategory, QueryParams $queryParams)
    {
        $this->subCategory = $subCategory;
        $this->queryParams = $queryParams;
    }

    /**
     * Query to get all subcategories according to request
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->subCategory
            ->where('sub_categories.name', 'like', "%{$this->queryParams->search}%")
            ->orWhere('categories.name', 'like', "%{$this->queryParams->search}%")
            ->select([
                'sub_categories.id',
                'sub_categories.name',
                'categories.name AS category_name'
            ])
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->orderBy($this->queryParams->order,$this->queryParams->orderDirection)
            ->get();
    }

    /**
     * Save SubCategory
     * @param $data
     * @return SubCategory
     */
    public function save($data): SubCategory
    {
        $subCategory = new SubCategory();
        $subCategory->name = $data['name'];
        $subCategory->category_id = $data['category_id'];
        $subCategory->save();
        return $subCategory->fresh();
    }
}
