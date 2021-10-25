<?php

namespace App\Http\Services;

use App\Exceptions\SaveException;
use App\Models\OrderPrice;
use Illuminate\Database\Eloquent\Collection;

class OrderPriceService
{
    /**
     * @throws SaveException
     */
    function create($orderId, $userId, $pairId, $price): OrderPrice
    {
        try {
            $orderPrice = new OrderPrice();
            $orderPrice->order_id = $orderId;
            $orderPrice->user_id = $userId;
            $orderPrice->pair_id = $pairId;
            $orderPrice->price = $price;
            $orderPrice->saveOrFail();
        } catch (\Throwable $e) {
            throw new SaveException();
        }
        return $orderPrice;
    }

    function getByOrder($orderId): Collection
    {
        return OrderPrice::whereOrderId($orderId)->get();
    }

}