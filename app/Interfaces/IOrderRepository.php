<?php

namespace App\Interfaces;

use App\Models\Order;

interface IOrderRepository
{
    public function create(array $data): Order;

}
