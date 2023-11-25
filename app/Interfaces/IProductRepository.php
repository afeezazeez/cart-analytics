<?php

namespace App\Interfaces;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface IProductRepository
{
    public function getByUUid(string $uuid):Product;
    public function getAll():LengthAwarePaginator;

}
