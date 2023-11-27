<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface IProductRepository
{
    public function getAll():LengthAwarePaginator;
}
