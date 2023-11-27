<?php

namespace App\Repositories;

use App\Interfaces\IOrderRepository;
use App\Models\Order;
use Illuminate\Support\Arr;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

}
