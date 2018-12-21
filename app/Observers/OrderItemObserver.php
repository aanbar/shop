<?php

namespace App\Observers;

use App\OrderItems;

class OrderItemObserver
{

    public function saving(OrderItems $orderItem)
    {
        $Discount = $orderItem->product_discount_type === 'Fixed' ? $orderItem->product_discount : 0;
        if ( $orderItem->product_discount_type === 'Percentage' ) {
            $Discount = round(($orderItem->product_price * $orderItem->product_discount) /  100);
        }
        $subTotal = round($orderItem->product_price - $Discount, 2);
        $orderItem->calculated_discount = $Discount;
        $orderItem->subtotal = $subTotal;
        $orderItem->total = $subTotal * $orderItem->quantity;
    }
}
