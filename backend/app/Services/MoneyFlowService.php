<?php

namespace App\Services;

use App\Http\Validators\MoneyValidator;
use App\Models\MoneyFlow;
use App\Models\User;
use App\Repositories\MoneyFlowRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Throwable;

class MoneyFlowService
{
    /**
     * Repository of this service
     * @var MoneyFlowRepository
     */
    protected MoneyFlowRepository $moneyFlowRepository;

    /**
     * Model validator
     * @var MoneyValidator
     */
    protected MoneyValidator $moneyValidator;

    /**
     * MoneyFlowService constructor.
     * @param MoneyFlowRepository $moneyFlowRepository
     * @param MoneyValidator $moneyValidator
     */
    public function __construct(MoneyFlowRepository $moneyFlowRepository, MoneyValidator $moneyValidator)
    {
        $this->moneyFlowRepository = $moneyFlowRepository;
        $this->moneyValidator = $moneyValidator;
    }

    /**
     * @param User $user
     * @param string $date
     * @return Collection
     * @throws Exception
     */
    public function getMonthly(User $user, string $date): Collection
    {
        return$this->moneyFlowRepository->getMonthly($user, $date);
    }

    /**
     * @param Request $request
     * @return MoneyFlow
     */
    public function saveData(Request $request): MoneyFlow
    {
        if (!$request['user_id']) {
            $request['user_id'] = auth()->id();
        }

        $validator = $this->moneyValidator->store($request->all());
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        return $this->moneyFlowRepository->save($request);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return MoneyFlow
     * @throws Throwable
     */
    public function updateData(Request $request, int $id): MoneyFlow
    {
        $money = MoneyFlow::find($id);
        if (!$money) {
            throw new Exception('Money transaction was not found',404);
        }

        $validator = $this->moneyValidator->update($request->all());
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $money = $this->moneyFlowRepository->update($request, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to update money data');
        }

        DB::commit();

        return $money;
    }

    /**
     * @param int $id
     * @return MoneyFlow
     * @throws Throwable
     */
    public function deleteById(int $id): MoneyFlow
    {
        $money = MoneyFlow::find($id);
        if (!$money) {
            throw new Exception('Money transaction was not found', 404);
        }

        DB::beginTransaction();
        try {
            $money = $this->moneyFlowRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete money transaction data');
        }

        DB::commit();
        return $money;
    }
}
