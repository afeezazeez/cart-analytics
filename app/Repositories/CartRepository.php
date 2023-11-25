<?php

namespace App\Repositories;

use App\Interfaces\ICartRepository;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;


class CartRepository implements ICartRepository
{

    protected Cart $model;

    public function __construct(Cart $model)
    {
        $this->model = $model;
    }

    /**
     * Create new auth user cart
     *
     * @return Cart
     */
    public function create(): Cart
    {
        return $this->model->create(['user_id' => auth()->id()]);
    }


    /**
     * Get auth user cart
     *
     * @return Cart|null
     */
    public function get(): Cart|null
    {
        return $this->model->where('user_id', auth()->id())
            ->where('status', Cart::STATUS_ACTIVE)
            ->first();
    }



}
