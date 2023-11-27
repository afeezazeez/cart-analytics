<?php

namespace App\Http\Controllers\Api\Shop;


use App\Http\Controllers\Controller;
use App\Http\Resources\RemovedItemResource;
use App\Services\CartService;

class RemovedCartItemController extends Controller
{

    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Fetch items removed from cart by users before checkout
     */
    public function __invoke()
    {
        $products = $this->cartService->getRemovedItems();
        return RemovedItemResource::collection($products);
    }
}
