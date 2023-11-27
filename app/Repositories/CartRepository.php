<?php

namespace App\Repositories;

use App\Interfaces\ICartRepository;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;


class CartRepository extends BaseRepository implements ICartRepository
{

    public function __construct(Cart $model)
    {
        parent::__construct($model);
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
