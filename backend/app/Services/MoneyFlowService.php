<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\MoneyFlowRepository;
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
     * @throws \Exception
     */
    public function getMonthly(User $user, string $date): Collection
    {
        return$this->moneyFlowRepository->getMonthly($user, $date);
    }

}
