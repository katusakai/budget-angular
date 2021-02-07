<?php

namespace App\Repositories;

use App\Models\Category;
use App\Services\QueryParams;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Exception;

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

    /**
     * Query to get all categories according to request
     * @return Collection
     */
    public function getForUser(): Collection
    {
        return $this->category
            ->select(['id', 'name'])
            ->where('name', 'like', "%{$this->queryParams->search}%")
            ->orderBy($this->queryParams->order,$this->queryParams->orderDirection)
            ->get();
    }

    /**
     * Save Category
     * @param Request $data
     * @return Category
     */
    public function save(Request $data): Category
    {
        $category = new Category;
        $category->name = $data['name'];
        $category->save();
        return $category->fresh();
    }

    /**
     * Returns specific category
     * @param int $id
     * @return Category
     * @throws Exception
     */
    public function getById(int $id): Category
    {
        $category = $this->category->find($id);
        if (!$category) {
            throw new Exception();
        }
        return $category;
    }

    /**
     * Updates category
     * @param Request $data
     * @param $id
     * @return Category
     */
    public function update(Request $data, $id): Category
    {
        $category = $this->category->find($id);
        $category->name = $data['name'];
        $category->update();
        return $category;
    }

    /**
     * Soft deletes category
     * @param int $id
     * @return Category
     * @throws Exception
     */
    public function delete(int $id): Category
    {
        $category = $this->category->find($id);
        $category->delete();
        return $category;
    }
}
