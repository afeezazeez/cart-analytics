<?php

namespace App\Http\Controllers\Api\Shop;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function __invoke(): LengthAwarePaginator
    {
        $products = $this->productService->getAll();
        return ProductResource::collection($products)->resource;
    }
}
