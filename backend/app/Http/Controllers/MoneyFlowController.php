<?php

namespace App\Http\Controllers;

use App\Http\Validators\MoneyValidator;
use App\Models\MoneyFlow;
use App\Models\User;
use App\Services\MoneyFlowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;
use Throwable;

class MoneyFlowController extends BaseController
{
    /**
     * Service for controller
     * @var MoneyFlowService
     */
    protected MoneyFlowService $moneyFlowService;

    /**
     * MoneyFlowController constructor.
     * @param MoneyFlowService $moneyFlowService
     */
    public function __construct(MoneyFlowService $moneyFlowService)
    {
        $this->moneyFlowService = $moneyFlowService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @param string $date
     * @return JsonResponse
     * @throws \Exception
     */
    public function index(User $user, string $date): JsonResponse
    {
        $money = $this->moneyFlowService->getMonthly($user, $date);
        return $this->sendResponse($money, 'A list of transactions have been shown');
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
            $moneyFlow = $this->moneyFlowService->saveData($request);
            return $this->sendResponse($moneyFlow, 'Transaction entry was created', 201);
        } catch (Exception $e) {
            return $this->sendError('Validation Error', json_decode($e->getMessage()), 400);
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
     * @param int $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function update(int $id, Request $request)
    {
        try {
            $moneyFlow = $this->moneyFlowService->updateData($request, $id);
            return $this->sendResponse($moneyFlow, 'Transaction entry was updated');
        } catch (Exception $e) {
            if ($e->getCode() !== 0) {
                return $this->sendError($e->getMessage(), [], $e->getCode());
            }
            return $this->sendError('Errors occurred', json_decode($e->getMessage()), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $moneyFlow = MoneyFlow::find($id);

        if ($moneyFlow === null)
            return $this->sendError('Entry not found');

        $moneyFlow->deleted = 1;
        $moneyFlow->save();
        return $this->sendResponse($moneyFlow, 'Entry was deleted');
    }
}
