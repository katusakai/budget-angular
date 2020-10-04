<?php

namespace App\Services;

use App\Http\Validators\MoneyValidator;
use App\Models\MoneyTransaction;
use App\Models\User;
use App\Repositories\MoneyTransactionRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Throwable;

class MoneyTransactionService
{
    /**
     * Repository of this service
     * @var MoneyTransactionRepository
     */
    protected MoneyTransactionRepository $moneyTransactionRepository;

    /**
     * Model validator
     * @var MoneyValidator
     */
    protected MoneyValidator $moneyValidator;

    /**
     * MoneyTransactionService constructor.
     * @param MoneyTransactionRepository $moneyTransactionRepository
     * @param MoneyValidator $moneyValidator
     */
    public function __construct(MoneyTransactionRepository $moneyTransactionRepository, MoneyValidator $moneyValidator)
    {
        $this->moneyTransactionRepository = $moneyTransactionRepository;
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
        return$this->moneyTransactionRepository->getMonthly($user, $date);
    }

    /**
     * @param Request $request
     * @return MoneyTransaction
     */
    public function saveData(Request $request): MoneyTransaction
    {
        if (!$request['user_id']) {
            $request['user_id'] = auth()->id();
        }

        $validator = $this->moneyValidator->store($request->all());
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        return $this->moneyTransactionRepository->save($request);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return MoneyTransaction
     * @throws Throwable
     */
    public function updateData(Request $request, int $id): MoneyTransaction
    {
        $money = MoneyTransaction::find($id);
        if (!$money) {
            throw new Exception('Money transaction was not found',404);
        }

        $validator = $this->moneyValidator->update($request->all());
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        DB::beginTransaction();

        try {
            $money = $this->moneyTransactionRepository->update($request, $id);
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
     * @return MoneyTransaction
     * @throws Throwable
     */
    public function deleteById(int $id): MoneyTransaction
    {
        $money = MoneyTransaction::find($id);
        if (!$money) {
            throw new Exception('Money transaction was not found', 404);
        }

        DB::beginTransaction();
        try {
            $money = $this->moneyTransactionRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete money transaction data');
        }

        DB::commit();
        return $money;
    }
}
