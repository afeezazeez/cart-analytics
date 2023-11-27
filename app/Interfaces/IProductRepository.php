<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;


interface IProductRepository
{
    public function getAll(): LengthAwarePaginator;
}
