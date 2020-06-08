<?php


namespace App\Aggregators;


use App\User;
use Illuminate\Support\Facades\DB;

class MoneyAggregator
{
    public function getMonthly(User $user, string $date)
    {
        $date = new \DateTime($date);
        $year = $date->format('Y');
        $month = $date->format('m');
        $money = DB::table('sub_categories')
            ->join('money_flows', 'money_flows.sub_category_id', '=', 'sub_categories.id')
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->select('money_flows.id', 'money_flows.user_id', 'money_flows.amount', 'money_flows.created_at', 'sub_categories.name AS sub_category_name', 'money_flows.description', 'categories.name AS category_name', 'sub_categories.id AS sub_category_id')
            ->where('money_flows.user_id', $user->id)
            ->where('money_flows.deleted', 0)
            ->whereYear('money_flows.created_at', $year)
            ->whereMonth('money_flows.created_at', $month)
            ->orderBy('money_flows.created_at', 'desc')
            ->get()->toArray();

        foreach ($money as $key => $spending) {
            $this->aggregate($spending);
            $money[$key] = $spending;
        }

        return $money;
    }

    private function aggregate($spending)
    {
        $spending->amount = floatval(decrypt($spending->amount));
    }

}
