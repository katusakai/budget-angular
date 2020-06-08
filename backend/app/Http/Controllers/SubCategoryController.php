<?php

namespace App\Http\Controllers;

use App\Http\Validators\SubCategoryValidator;
use App\SubCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $search = request()['search'] && request()['search'] !== '' ? request()['search'] : '%';

        $subCategories = DB::table('sub_categories')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->select('sub_categories.id', 'sub_categories.name', 'categories.name AS category_name')
            ->where('sub_categories.name', 'like', "%{$search}%")
            ->orWhere('categories.name', 'like', "%{$search}%")
            ->where('sub_categories.deleted', 0)
            ->orderBy('sub_categories.name')
            ->get();
        return $this->sendResponse($subCategories, '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = SubCategoryValidator::validate($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $subCategory = new SubCategory();
        $subCategory->category_id = $request->category_id;
        $subCategory->name = $request->name;
        $subCategory->save();
        return $this->sendResponse($subCategory, 'Subcategory was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
