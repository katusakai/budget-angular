<?php

namespace App\Http\Controllers;

use App\Services\SubCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class SubCategoryController extends BaseController
{
    protected SubCategoryService $subCategoryService;

    /**
     * SubCategoryController constructor.
     * @param SubCategoryService $subCategoryService
     */
    public function __construct(SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $subCategories = $this->subCategoryService->getAll();
        if (count($subCategories)) {
            $message ='A list of subcategories have been shown';
        } else {
            $message ='No subcategories were found';
        }
        return $this->sendResponse($subCategories, $message);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $category = $this->subCategoryService->saveData($request);
            return $this->sendResponse($category, 'SubCategory was created', 201);
        } catch (Exception $e) {
            return $this->sendError('Validation Error', json_decode($e->getMessage()));
        }
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
