<?php

namespace App\Interfaces;

use App\Models\Cart;
use App\Models\CartItem;

interface ICartItemRepository
{
    public function create(array $data): CartItem;
    public function getItem(Cart $cart, $product_id): CartItem|null;
    public function getItems(Cart $cart): array;
    public function increaseQty(CartItem $cartItem): void;
    public function restoreItem(CartItem $cartItem): void;
}
