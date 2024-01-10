<?php

namespace App\Http\Controllers\Api\Shop;


use App\Http\Controllers\Controller;
use App\Http\Resources\RemovedItemResource;
use App\Services\CartService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

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
    public function __invoke(): AnonymousResourceCollection
    {
        $meta = [
            'page' => request()->page ?? 1,
            'limit' => request()->limit ?? config('app.default_pagination_size')
        ];
        $products = $this->cartService->getRemovedItems($meta);
        return RemovedItemResource::collection($products);
    }
}
