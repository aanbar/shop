<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->product_name,
            'quantity' => $this->quantity,
            'original_price' => $this->product_price,
            'discount' => $this->calculated_discount,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'bundled_items' => $this->bundle_data
        ];
    }
}
