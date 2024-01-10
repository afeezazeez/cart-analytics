<?php

namespace App\Interfaces;

use App\Models\Cart;


interface ICartRepository
{
    public function get(int $user_id): Cart|null;
}
