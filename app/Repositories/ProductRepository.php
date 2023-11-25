<?php

namespace App\Repositories;

use App\Interfaces\IProductRepository;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements IProductRepository
{
    protected Product $model;
    /**
     * @var int|mixed
     */
    private mixed $limit;
    /**
     * @var int|mixed
     */
    private mixed $page;

    public function __construct(Product $model)
    {
        $this->model = $model;
        $this->page  = request()->page ?? 1;
        $this->limit = request()->limit ?? 20;
    }


    /**
     * Fetch all products in the database
     *
     * @return LengthAwarePaginator
     */
    public function getAll():LengthAwarePaginator
    {
        return $this->model->paginate($this->limit,['*'],'page',$this->page);
    }

}
