<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Http\Resources\ProductResource;
use App\Interfaces\ICartItemRepository;
use App\Interfaces\ICartRepository;
use App\Interfaces\IProductRepository;
use App\Models\Cart;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartService
{

    private ICartRepository $cartRepository;
    private ICartItemRepository $cartItemRepository;
    private IProductRepository $productRepository;

    public function __construct(
        ICartRepository     $cartRepository,
        ICartItemRepository $cartItemRepository,
        IProductRepository  $productRepository
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

        DB::beginTransaction();

        try {

            $product = $this->productRepository->getByUUid($uuid);

            $userCart = $this->getCart();

            $cartItem = $this->cartItemRepository->getItem($userCart, $product->id);

            if ($cartItem) {

                if ($cartItem->trashed()) {
                    // Product was previously removed, restore and update quantity to 1
                    $this->cartItemRepository->restoreItem($cartItem);
                } else {
                    // Product is already in the cart,  Increase product quantity
                    $this->cartItemRepository->increaseQty($cartItem);
                }

            } else {
                // Product is not in the cart, create a new cart item
                $data = [
                    'cart_id' => $userCart->id,
                    'product_id' => $product->id,
                    'quantity' => 1
                ];
                $cartItem = $this->cartItemRepository->create($data);
            }

            DB::commit();

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
     * remove product from cart for auth user
     *
     * @param string $uuid
     * @return bool
     * @throws ClientErrorException
     */
    public function removeFromCart(string $uuid): bool
    {
        DB::beginTransaction();

        $product = $this->productRepository->getByUUid($uuid);

        $userCart = $this->getCart();

        $cartItem = $this->cartItemRepository->getItem($userCart, $product->id);

        if (!$cartItem || $cartItem->trashed()) {
            throw new ClientErrorException("Item does not exist in cart");
        }

        try {

            $this->cartItemRepository->delete($cartItem);

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw new ClientErrorException('Unable to remove product from cart. Try again');
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


    /**
     * get total amount for all items in  cart
     *
     * @param array $cartItems
     * @return int|float
     */
    public function getCartTotalAmount(array $cartItems): float|int
    {
        return array_sum(array_map(function ($cartItem) {

            if (isset($cartItem['product']) && is_array($cartItem['product'])) {

                $product = $cartItem['product'];

                $quantity = $cartItem['quantity'];

                // Ensure that the product has a 'price' key
                if (isset($product['price'])) {

                    return $quantity * $product['price'];

                }
            }
            return 0;
        }, $cartItems));

    }

    /**
     *  Fetch items removed from cart by users before checkout
     *
     */
    public function getRemovedItems(): LengthAwarePaginator
    {
        return $this->cartItemRepository->getRemovedItems();
    }


}
