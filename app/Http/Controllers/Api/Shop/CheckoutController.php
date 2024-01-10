<?php

namespace App\Http\Controllers\Api\Shop;

use App\Exceptions\ClientErrorException;
use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\JsonResponse;

class CheckoutController extends Controller
{

    private CheckoutService $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    /**
     * checkout
     *
     * @return JsonResponse
     * @throws ClientErrorException
     */
    public function __invoke(): JsonResponse
    {

        if ($this->checkoutService->checkout(auth()->id())) {
            return successResponse("Order successfully placed. Kindly wait while it is being processed");
        }

        throw new ClientErrorException('Checkout failed!.Try again');

    }
}
