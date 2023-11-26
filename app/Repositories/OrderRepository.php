<?php

namespace App\Repositories;

use App\Interfaces\IOrderRepository;
use App\Models\Order;
use Illuminate\Support\Arr;

class OrderRepository implements IOrderRepository
{
    protected Order $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }


    /**
     * Create new auth user order
     *
     *
     * @param array $data
     * @return Order
     */
    public function create($data): Order
    {
        $data = Arr::add($data, 'user_id', auth()->id());
        return $this->model->create($data);
    }

}
