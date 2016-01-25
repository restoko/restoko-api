<?php
namespace App\Http\Controllers\Pos;

use App\Http\Controllers\ApiController;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemsController extends ApiController
{
    /**
     * @param Request $request
     * @param $cartId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addItemToCart(Request $request, $cartId)
    {
        $productId = $request->get('product_id');
        $qty       = $request->get('quantity');

        // Check if the product is already in the cart
        $item = $this->checkAndUpdateProductInCart($cartId, $productId, $qty);
        if ($item) {
            return $this->responseOk($item);
        }

        // Create new item
        $data = [
            'cart_id'       => $cartId,
            'product_id'    => $productId,
            'quantity'      => $qty
        ];

        $item = CartItem::create($data);

        return $this->responseOk($item);
    }

    /**
     * @param $cartId
     * @param $productId
     * @param $qty
     * @return mixed
     */
    private function checkAndUpdateProductInCart($cartId, $productId, $qty)
    {
        $item = CartItem::where('cart_id', $cartId)
            ->where('product_id', $productId)->first();

        if (! $item) {
            return false;
        }

        $item->quantity = (int)$item->quantity + (int)$qty;
        $item->save();

        return $item;
    }
}