<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['total_amount', 'user_id', 'reference', 'status', 'cart_id','uuid'];

    const STATUS_PENDING = 'processing';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'cancelled';


    /**
     * Generate order reference while creating it
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->reference = generateReference();
        });

    }

}
