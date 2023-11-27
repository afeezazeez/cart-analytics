<?php

namespace App\Services;

use App\Exceptions\ClientErrorException;
use App\Interfaces\ICartItemRepository;
use App\Interfaces\ICartRepository;
use App\Interfaces\IOrderRepository;
use App\Interfaces\IProductRepository;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutService
{

    private IOrderRepository $orderRepository;
    private CartService $cartService;
    private ICartRepository $cartRepository;
    private ICartItemRepository $cartItemRepository;

    public function __construct(
        IOrderRepository    $orderRepository,
        ICartRepository     $cartRepository,
        ICartItemRepository $cartItemRepository,
        CartService         $cartService,

    )
    {
        $this->orderRepository     = $orderRepository;
        $this->cartRepository      = $cartRepository;
        $this->cartItemRepository = $cartItemRepository;
        $this->cartService         = $cartService;
    }

    /**
     * Checkout
     *
     * @return bool
     * @throws ClientErrorException
     */
    public function checkout(): bool
    {

        $userCart = $this->cartService->getCart();

        $cartItems = $this->cartItemRepository->getItems($userCart);

        if (empty($cartItems)){
           throw new ClientErrorException('Please add a product to cart before checkout');
        }

        $grandTotal = $this->cartService->getCartTotalAmount($cartItems);

        DB::beginTransaction();

        try {

            $data = [
                'cart_id' => $userCart->id,
                'total_amount' => $grandTotal,
                'user_id', auth()->id()
            ];

            if ($this->orderRepository->create($data)) {
                $this->cartRepository->update(['status' => Cart::STATUS_CHECKED_OUT],$userCart->uuid);
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            throw new ClientErrorException('Error checking out. Please try again');
        }

    }
}
