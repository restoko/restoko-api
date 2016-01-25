<?php
namespace App\Http\Controllers\Pos;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\Table;

class CartsController extends ApiController
{
    public function createCart($tableId)
    {
        // Check if table is available
        if (! $this->tableAvailable($tableId)) {
            return $this->responseBadRequest(['Table is not available']);
        }

        // Create New Cart
        $data = [
            'table_id'  => $tableId,
            'status'    => Table::OCCUPIED
        ];

        $cart = Cart::create($data);

        return $this->responseOk($cart);
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
}