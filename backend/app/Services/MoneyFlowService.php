<?php

namespace App\Services;

use App\Http\Validators\MoneyValidator;
use App\Models\MoneyFlow;
use App\Models\User;
use App\Repositories\MoneyFlowRepository;
use Exception;
use InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class MoneyFlowService
{
    /**
     * Repository of this service
     * @var MoneyFlowRepository
     */
    protected MoneyFlowRepository $moneyFlowRepository;

    /**
     * MoneyFlowService constructor.
     * @param MoneyFlowRepository $moneyFlowRepository
     */
    public function __construct(MoneyFlowRepository $moneyFlowRepository)
    {
        $this->moneyFlowRepository = $moneyFlowRepository;
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

        $validator = MoneyValidator::validate($request->all());
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors());
        }

        return $this->moneyFlowRepository->save($request);
    }

}
