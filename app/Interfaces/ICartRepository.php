<?php

namespace App\Interfaces;

use App\Models\Cart;


interface ICartRepository
{
    public function get(): Cart|null;
}
