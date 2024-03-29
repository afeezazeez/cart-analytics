<?php

namespace App\Interfaces;

use App\Models\Cart;
use App\Models\CartItem;

interface ICartItemRepository
{
    public function getItem(Cart $cart, $product_id): CartItem|null;

    public function getItems(Cart $cart): array;

}
