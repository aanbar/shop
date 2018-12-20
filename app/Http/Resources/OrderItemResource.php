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
        $Discount = $this->product_discount_type === 'Fixed' ? $this->product_discount : 0;
        if ( $this->product_discount_type === 'Percentage' ) {
            $Discount = round(($this->product_price * $this->product_discount) /  100);
        }
        $subTotal = round($this->product_price - $Discount, 2);
        return [
            'name' => $this->product_name,
            'quantity' => $this->quantity,
            'original_price' => $this->product_price,
            'discount' => $Discount,
            'subtotal' => $subTotal,
            'total' => $subTotal * $this->quantity,
            'bundled_items' => $this->bundle_data
        ];
    }
}
