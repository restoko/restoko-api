<?php
namespace App\Http\Controllers\Pos;

use App\Http\Controllers\ApiController;
use App\Models\CartItem;
use App\Models\Product;
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

        // Get product price
        $price = $this->getProductPrice($productId);

        // Create new item
        $data = [
            'cart_id'       => $cartId,
            'product_id'    => $productId,
            'quantity'      => $qty,
            'unit_price'    => $price,
            'status'        => 'pending'
        ];

        $item = CartItem::create($data);

        return response()->json($item);
    }

    private function getProductPrice($productId)
    {
        $price = 0;
        $product = Product::where('id', $productId)->first();

        return $product['price'];
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

    public function removeItemFromCart($cartId, $productId)
    {

        \Log::info("Deleting cartId ".$cartId." with product ".$productId);
        $item = CartItem::where('cart_id', $cartId)->where('product_id', $productId)->forceDelete();

        return $this->responseOk($item);
    }
}