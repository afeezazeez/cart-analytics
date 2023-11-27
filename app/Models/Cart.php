<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'status'];

    const STATUS_ACTIVE = 'active';
    const STATUS_CHECKED_OUT = 'checked_out';


    /**
     * Get items associated with cart
     */
    public function items(): HasMany
    {
        return $this->HasMany(CartItem::class);
    }

    /**
     * Get user associated with cart
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate uuid reference while creating it
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($cart) {
            $cart->uuid = Str::uuid();
        });

    }


}
