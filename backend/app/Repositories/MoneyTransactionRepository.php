<?php

namespace App\Repositories;

use App\Models\MoneyTransaction;
use App\Models\User;
use App\Services\QueryParams;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Exception;

class MoneyTransactionRepository
{
    /**
     * Model of repository
     * @var MoneyTransaction
     */
    protected MoneyTransaction $moneyTransaction;

    /**
     * Request query parameters list
     * @var QueryParams
     */
    protected QueryParams $queryParams;

    /**
     * CategoryRepository constructor.
     * @param MoneyTransaction $moneyTransaction
     * @param QueryParams $queryParams
     */
    public function __construct(MoneyTransaction $moneyTransaction, QueryParams $queryParams)
    {
        $this->moneyTransaction = $moneyTransaction;
        $this->queryParams = $queryParams;
    }

    /**
     * Gets data for specific user of specific month
     * @param User $user
     * @param string $date
     * @return Collection
     * @throws \Exception
     */
    public function getMonthly(User $user, string $date): Collection
    {
        $date = new \DateTime($date);
        $year = $date->format('Y');
        $month = $date->format('m');

        return MoneyTransaction::query()
            ->whereUserId($user->id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->select([
                'money_transaction.id',
                'money_transaction.user_id',
                'money_transaction.amount',
                'money_transaction.created_at',
                'money_transaction.description',
                'money_transaction.sub_category_id',
                'sub_category.name AS sub_category_name',
                'category.name AS category_name'])
            ->join('sub_category', 'sub_category.id', '=', 'sub_category_id')
            ->join('category', 'category.id', '=', 'sub_category.category_id')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * Save money transaction
     * @param $data
     * @return MoneyTransaction
     */
    public function save($data): MoneyTransaction
    {
        $money = new MoneyTransaction();
        $money->user_id = $data['user_id'];
        $money->sub_category_id = $data['sub_category_id'];
        $money->amount = $data['amount'];
        $money->description = $data['description'];
        $money->save();
        return $money->fresh();
    }

    /** Updates money transaction
     * @param Request $data
     * @param int $id
     * @return MoneyTransaction
     */
    public function update(Request $data, int $id): MoneyTransaction
    {
        $money = $this->moneyTransaction->find($id);
        $money->sub_category_id = $data['sub_category_id'];
        $money->amount = $data['amount'];
        $money->description = $data['description'];
        $money->update();
        return $money;
    }

    /**
     * Soft delete money transaction
     * @param int $id
     * @return MoneyTransaction
     * @throws Exception
     */
    public function delete(int $id): MoneyTransaction
    {
        $money = $this->moneyTransaction->find($id);
        $money->delete();
        return $money;
    }

}
