<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Validators\CategoryValidator;
use App\Services\QueryParams;
use App\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{

    protected $queryParams;

    /**
     * CategoryController constructor.
     * @param QueryParams $queryParams
     */
    public function __construct(QueryParams $queryParams)
    {
        $this->queryParams = $queryParams;
    }


    /**
     * Display a listing of the resource for admin.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $categories = Category::where('name', 'like', "%{$this->queryParams->search}%")
            ->when(in_array($this->queryParams->deleted, [0,1]),
                function ($query) {
                    return $query->where('deleted', '=', $this->queryParams->deleted);
                }
            )
            ->orderBy($this->queryParams->order,$this->queryParams->orderDirection)
            ->paginate($this->queryParams->limit);
        if ($categories) {
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
        $categories = DB::table('categories')
            ->select('categories.id', 'categories.name')
            ->where('categories.name', 'like', "%{$this->queryParams->search}%")
            ->where('categories.deleted', 0)
            ->orderBy('categories.name')
            ->get();
        return $this->sendResponse($categories, '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = CategoryValidator::validate($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $oldCategory = Category::where('name', $request->name)->first();
        if ($oldCategory)
        {
            $category = $oldCategory;
            $category->deleted = 0;
            $category->save();
        } else
        {
            $category = new Category();
            $category->name = $request->name;
            $category->save();
        }

        return $this->sendResponse($category, 'Category was created');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category)
            return $this->sendError('Category not found');

        return $this->sendResponse($category, 'Category was founded');
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
