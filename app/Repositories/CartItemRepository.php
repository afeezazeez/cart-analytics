<?php

namespace App\Repositories;

use App\Interfaces\ICartItemRepository;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class CartItemRepository extends BaseRepository implements ICartItemRepository
{
    /**
     * @var int|mixed
     */
    private mixed $limit;
    /**
     * @var int|mixed
     */
    private mixed $page;

    public function __construct(CartItem $model)
    {
        parent::__construct($model);
        $this->page  = request()->page ?? 1;
        $this->limit = request()->limit ?? config('app.default_pagination_size');
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
     * Get auth user  active cart items
     *
     * @param Cart $cart
     * @return array
     */
    public function getItems(Cart $cart): array
    {
        return $cart->items()
            ->with('product')
            ->get()->toArray();
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


    /**
     * Fetch items removed from cart by users before checkout
     */
    public function getRemovedItems(): LengthAwarePaginator
    {
       return $this->model->onlyTrashed()
           ->whereHas('cart', function ($query) {
                $query->where('status', 'checked_out');
            })
           ->with(['cart.user','product'])->
           paginate($this->limit,['*'],'page',$this->page);
    }

}
