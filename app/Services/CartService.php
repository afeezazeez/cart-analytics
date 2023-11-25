<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Http\Resources\ProductResource;
use App\Interfaces\ICartItemRepository;
use App\Interfaces\ICartRepository;
use App\Interfaces\IProductRepository;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartService
{

    private ICartRepository $cartRepository;
    private ICartItemRepository $cartItemRepository;
    private IProductRepository $productRepository;

    public function __construct(
        ICartRepository $cartRepository,
        ICartItemRepository $cartItemRepository,
        IProductRepository $productRepository
    )
    {
        $this->cartRepository = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Add product to cart for auth user
     *
     * @param string $uuid
     * @return array
     * @throws ClientErrorException
     */
    public function addToCart(string $uuid): array
    {

        try {

            $product = $this->productRepository->getByUUid($uuid);

            $userCart = $this->getCart();

            $cartItem = $this->cartItemRepository->getItem($userCart, $product->id);

            // If product is not in cart
            if (!$cartItem) {
                $data = [
                    'cart_id' => $userCart->id,
                    'product_id' => $product->id,
                    'quantity' => 1
                ];
                $cartItem = $this->cartItemRepository->create($data);

            } else{

                // Increase product quantity in cart
                $this->cartItemRepository->increaseQty($cartItem);
            }


            return [
                'quantity' => $cartItem->quantity,
                'product' => ProductResource::make($cartItem->product)
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw new ClientErrorException('Unable to add product to cart. Try again');
        }
    }


    /**
     * get auth user cart or create new cart for user
     *
     * @return Cart
     */
    public function getCart(): Cart
    {
        $userCart = $this->cartRepository->get();

        if (!$userCart) {

            $userCart = $this->cartRepository->create();

        }
        return $userCart;
    }


}
