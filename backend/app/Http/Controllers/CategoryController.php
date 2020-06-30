<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Validators\CategoryValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $search = request()['search'] && request()['search'] !== '' ? request()['search'] : '%';

        $categories = DB::table('categories')
            ->select('categories.id', 'categories.name')
            ->where('categories.name', 'like', "%{$search}%")
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

        $category = new Category();
        $category->name = $request->name;
        $category->save();

        return $this->sendResponse($category, 'Category was created');
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
