<?php
namespace App\Http\Controllers\Pos;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Table;
use Illuminate\Http\Request;

class CartsController extends ApiController
{

    /**
     * Get the cart information
     *
     * @param $cartId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCart($tableId)
    {
        $cart = Cart::with('items.product.category')
            ->where('table_id', $tableId)
            ->Where(function($q) {
                $q->where('status', Cart::PENDING)->orWhere('status', Cart::CONFIRMED);
            })
            ->first();

        if (! $cart) {
            return $this->responseNotFound(['There is no cart with that table id']);
        }

        $cart = $this->parseCart($cart);

        return response()->json($cart);
    }

    private function parseCart($cart)
    {
        $items = $cart['items'];
        unset($cart['items']);

        $result = [
            'info' => $cart->toArray(),
            'items' => []
        ];

        foreach($items as $item) {
            $result['items'][] = [
                'item_id'           => $item['id'],
                'discount_percentage'   => $item['discount_percentage'],
                'category'          => $item['product']['category']['name'],
                'prodcut_id'        => $item['product']['id'],
                'product_picture'   => $item['product']['picture'],
                'product_name'      => $item['product']['name'],
                'product_price'     => $item['unit_price'],
                'quantity'          => $item['quantity'],
                'status'            => $item['status']
            ];
        }

        return $result;
    }

    public function confirmOrder($cartId)
    {
        $cart = Cart::where('id', $cartId)->update(['status' => CART::CONFIRMED]);

        return $this->responseOk($cart);
    }

    public function completeOrder($cartId)
    {
        $cart = Cart::where('id', $cartId)->update(['status' => CART::COMPLETED]);
        $cart = Cart::where('id', $cartId)->first();

        // Update the table status
        if (! $this->makeTableAvailable($cart['table_id'])) {
            return $this->responseBadRequest(['Table not found']);
        }

        return $this->responseOk($cart);
    }

    /**
     * Create a new cart
     *
     * @param $tableId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createNewCart(Request $request)
    {
        $input = $request->all();
        $tableId = $input['table_id'];

        // Check if table is available
        if (! $this->tableAvailable($tableId)) {
            return $this->responseBadRequest(['Table is not available']);
        }

        // Update the table status
        if (! $this->makeTableOccupied($tableId)) {
            return $this->responseBadRequest(['Table not found']);
        }

        // Create New Cart
        $cart = $this->createCart($input);

        return response()->json($cart);
    }

    public function discountedCart(Request $request, $cartId)
    {
        $input = $request->only('discount_percentage');

        if (! $input['discount_percentage']) {
            $input['discount_percentage'] = 0;
        }

        $cart = Cart::where('id', $cartId)->update([
            'discount_percentage' => $input['discount_percentage'
            ]]);

        return $this->responseOk($cart);
    }

    /**
     * Create the cart
     *
     * @param $tableId
     * @return static
     */
    private function createCart($data)
    {
        return Cart::create($data);
    }

    /**
     * Check if table is available
     *
     * @param $tableId
     * @return bool
     */
    private function tableAvailable($tableId)
    {
        $table = Table::where('id', $tableId)
            ->where('status', Table::AVAILABLE)
            ->first();

        if (! $table) {
            return false;
        }

        return true;
    }

    /**
     * Make the table occupied
     *
     * @param $tableId
     * @return mixed
     */
    private function makeTableOccupied($tableId)
    {
        $table = Table::where('id', $tableId)
            ->update(['status' => Table::OCCUPIED]);

        return $table;
    }

    /**
     * Make the table occupied
     *
     * @param $tableId
     * @return mixed
     */
    private function makeTableAvailable($tableId)
    {
        $table = Table::where('id', $tableId)
            ->update(['status' => Table::AVAILABLE]);

        return $table;
    }
}