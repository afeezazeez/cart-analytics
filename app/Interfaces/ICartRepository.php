<?php

namespace App\Interfaces;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;

interface ICartRepository
{
    public function create(): Cart;
    public function get(): Cart|null;
    public function update(Cart $cart, $data): void;
}
