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
                'quantity'      => $item['quantity'],
                'table'         => $item['cart']['table']['name'],
                'status'        => $item['status']
            ];
        }

        return $result;
    }

    public function completeOrder($cartItemId)
    {
        $item = CartItem::where('id', $cartItemId)->update(['status' => 'completed']);

        $items = CartItem::with('product', 'cart.table')
            ->where('status', 'pending')
            ->get();

        return $this->responseOk($this->parseItems($items->toArray()));
    }
}