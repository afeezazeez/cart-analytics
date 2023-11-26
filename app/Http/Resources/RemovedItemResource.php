<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RemovedItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product' => ProductResource::make($this->product),
            'user' => UserResource::make($this->cart->user),
            'cart' => CartResource::make($this->cart)
        ];
    }
}
