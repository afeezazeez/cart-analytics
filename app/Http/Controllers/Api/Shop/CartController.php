<?php

namespace App\Http\Controllers\Api\Shop;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CartProductRequest;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }


    /**
     * Add product to cart
     *
     * @param CartProductRequest $request
     * @return JsonResponse
     * @throws ClientErrorException
     */
    public function store(CartProductRequest $request): JsonResponse
    {
        $product = $this->cartService->addToCart($request->uuid);
        return successResponse("Product added to cart",$product);
    }

    /**
     * Remove product from cart
     *
     * @param CartProductRequest $request
     * @return JsonResponse
     * @throws ClientErrorException
     */
    public function destroy(CartProductRequest $request): JsonResponse
    {
        if ($this->cartService->removeFromCart($request->uuid)) {
            return successResponse("Product removed from cart");
        }

    }


}
