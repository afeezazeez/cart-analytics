<?php

namespace App\Repositories;

use App\Interfaces\ICartItemRepository;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class CartItemRepository extends BaseRepository implements ICartItemRepository
{

    public function __construct(CartItem $model)
    {
        parent::__construct($model);

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
     * Fetch items removed from cart by users before checkout
     */
    public function getRemovedItems(array $meta): LengthAwarePaginator
    {
        return $this->model->onlyTrashed()
            ->whereHas('cart', function ($query) {
                $query->where('status', 'checked_out');
            })
            ->with(['cart.user', 'product'])->
            paginate($meta['limit'], ['*'], 'page',$meta['page']);
    }

}
