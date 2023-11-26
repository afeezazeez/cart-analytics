<?php

namespace App\Repositories;

use App\Interfaces\ICartItemRepository;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Arr;

class CartItemRepository implements ICartItemRepository
{

    protected CartItem $model;

    public function __construct(CartItem $model)
    {
        $this->model = $model;
    }

    /**
     * Create new auth user cart item
     *
     * @param $data
     * @return CartItem
     */
    public function create($data): CartItem
    {
        $data = Arr::add($data, 'user_id', auth()->id());
        return $this->model->create($data);
    }

    /**
     * Remove item from cart
     *
     * @param CartItem $cartItem
     * @return bool
     */
    public function delete(CartItem $cartItem): bool
    {
        return $cartItem->delete();
    }

    /**
     * Get particular auth user cart item
     *
     * @param Cart $cart
     * @param int $product_id
     * @return CartItem|null
     */
    public function getItem(Cart $cart, $product_id): CartItem|null
    {
        return $cart->items()->withTrashed()->where('product_id', $product_id)->first();
    }

    /**
     * Increase quantity of an item (product in cart)
     *
     * @param CartItem $cartItem
     * @return void
     */
    public function increaseQty(CartItem $cartItem): void
    {
         $cartItem->increment('quantity');
    }

    /**
     * Restore item removed from cart and later re-added
     *
     * @param CartItem $cartItem
     * @return void
     */
    public function restoreItem(CartItem $cartItem): void
    {
        $cartItem->restore();

        $cartItem->update(['quantity'=>1]);
    }


}
