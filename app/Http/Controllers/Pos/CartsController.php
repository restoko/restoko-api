<?php
namespace App\Http\Controllers\Pos;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Table;

class CartsController extends ApiController
{

    /**
     * Get the cart information
     *
     * @param $cartId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCart($cartId)
    {
        $cart = Cart::with('items.product.category')->where('id', $cartId)->first();

        if (! $cart) {
            return $this->responseNotFound(['There is no cart with that id']);
        }

        return $this->responseOk($cart);
    }

    /**
     * Create a new cart
     *
     * @param $tableId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createNewCart($tableId)
    {
        // Check if table is available
        if (! $this->tableAvailable($tableId)) {
            return $this->responseBadRequest(['Table is not available']);
        }

        // Update the table status
        if ($this->makeTableOccupied($tableId)) {
            return $this->responseBadRequest(['Table not found']);
        }

        // Create New Cart
        $cart = $this->createCart($tableId);

        return $this->responseOk($cart);
    }

    /**
     * Create the cart
     *
     * @param $tableId
     * @return static
     */
    private function createCart($tableId)
    {
        $data = [
            'table_id'  => $tableId,
            'status'    => Cart::ACTIVE
        ];

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
}