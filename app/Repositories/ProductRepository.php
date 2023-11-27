<?php

namespace App\Repositories;

use App\Interfaces\IProductRepository;
use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository extends BaseRepository implements IProductRepository
{
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
        parent::__construct($model);
        $this->page  = request()->page ?? 1;
        $this->limit = request()->limit ?? config('app.default_pagination_size');
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
