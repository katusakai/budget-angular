<?php


namespace App\Services;


class QueryParams
{
    public $limit;
    public $search;
    public $order;
    public $orderDirection;
    public $deleted;

    /**
     * QueryParams constructor.
     */
    public function __construct()
    {
        $this->limit  = request()['limit'] && is_numeric(request()['limit']) ? intval(request()['limit']) : 15;
        $this->search = request()['search'] && request()['search'] !== '' ? request()['search'] : '%';
        $this->order = request()['order'] && request()['order'] !== '' ? request()['order'] : 'name';
        $this->orderDirection = request()['orderDirection'] && request()['orderDirection'] !== '' ? request()['orderDirection'] : 'asc';
        $this->deleted = request()['deleted'] && request()['deleted'] !== '' ? intval(request()['deleted']) : 0;
    }


}
