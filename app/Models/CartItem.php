<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['cart_id', 'product_id', 'quantity','uuid'];

    /**
     * Get product associated with cart item
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get product associated with cart item
     */
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }




}
