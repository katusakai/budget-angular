<?php

namespace App\Repositories;

use App\Models\Category;
use App\Services\QueryParams;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    /**
     * Model of repository
     * @var Category
     */
    protected Category $category;

    /**
     * Request query parameters list
     * @var QueryParams
     */
    protected QueryParams $queryParams;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     * @param QueryParams $queryParams
     */
    public function __construct(Category $category, QueryParams $queryParams)
    {
        $this->category = $category;
        $this->queryParams = $queryParams;
    }

    /**
     * Query to get all categories according to request
     * @return LengthAwarePaginator
     */
    public function getAll(): LengthAwarePaginator
    {
        return $this->category
            ->where('name', 'like', "%{$this->queryParams->search}%")
            ->orderBy($this->queryParams->order,$this->queryParams->orderDirection)
            ->paginate($this->queryParams->limit);
    }
}
