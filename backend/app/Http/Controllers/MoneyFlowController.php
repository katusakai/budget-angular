<?php

namespace App\Http\Controllers;

use App\Aggregators\MoneyAggregator;
use App\Http\Validators\MoneyValidator;
use App\MoneyFlow;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MoneyFlowController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @param string $date
     * @param MoneyAggregator $moneyAggregator
     * @return JsonResponse
     */
    public function index(User $user, string $date, MoneyAggregator $moneyAggregator)
    {
        $money = $moneyAggregator->getMonthly($user, $date);

        return $this->sendResponse($money, '');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = MoneyValidator::validate($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $moneyFlow = new MoneyFlow();
        $moneyFlow->user_id = auth()->id();
        $moneyFlow->sub_category_id = $request->sub_category_id;
        $moneyFlow->amount = round($request->amount,2);
        $moneyFlow->description = $request->description;
        $moneyFlow->save();

        return $this->sendResponse($moneyFlow, 'Entry was created');
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
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {
        $validator = MoneyValidator::validate($request->all());

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $moneyFlow = MoneyFlow::find($id);

        if ($moneyFlow === null)
            return $this->sendError('Entry not found');

        $moneyFlow->sub_category_id = $request->sub_category_id;
        $moneyFlow->amount = round($request->amount,2);
        $moneyFlow->description = $request->description;
        $moneyFlow->save();

        return $this->sendResponse($moneyFlow, 'Entry was updated');
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
