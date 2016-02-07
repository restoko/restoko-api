<?php
namespace App\Http\Controllers\Kitchen;

use App\Http\Controllers\ApiController;
use App\Models\CartItem;

class CartItemsController extends ApiController
{
    public function getPendingOrders()
    {
        $items = CartItem::with('product', 'cart.table')
            ->where('status', 'pending')
            ->get();

        if ($items->isEmpty()) {
            return $this->responseOk([]);
        }

        return $this->responseOk($this->parseItems($items->toArray()));
    }

    private function parseItems($items)
    {
        $result = [];

        foreach ($items as $item) {
            $result[] = [
                'cart_item_id'  => $item['id'],
                'product_name'  => $item['product']['name'],
                'table'         => $item['cart']['table']['name'],
                'status'        => $item['status']
            ];
        }

        return $result;
    }
}