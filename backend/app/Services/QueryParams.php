<?php


namespace App\Services;


class QueryParams
{
    /**
     * Limit of data entries for one page
     * @var int
     */
    public int $limit;

    /**
     * Value typed in search
     * @var mixed|string
     */
    public string $search;

    /**
     * Column name to order by
     * @var mixed|string
     */
    public string $order;

    /**
     * Order direction
     * @var mixed|string
     */
    public string $orderDirection;

    /**
     * Param to define if requested for deleted data
     * @var int
     */
    public int $deleted;

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
