<?php
namespace App\Http\Controllers\Reports;

use App\Http\Controllers\ApiController;
use App\Models\Cart;
use App\Models\CartItem;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesController extends ApiController
{
    public function getSales(Request $request)
    {
        $input = $request->all();
        $startDate = Carbon::today('Asia/Manila')->subDays(30);
        $endDate = Carbon::today('Asia/Manila');

        if (isset($input['from'])) {
            $startDate = Carbon::createFromTimestamp(strtotime($input['from']));
            $endDate = Carbon::createFromTimestamp(strtotime($input['to']));
        }

        $carts = Cart::where('status', 'completed')
            ->whereDate('created_at', '>=', $startDate->toDateString())
            ->whereDate('created_at', '<=', $endDate->toDateString())
            ->get();

        $data = [];

        $difference = $endDate->diffInDays($startDate);

        $date = $startDate;
        for ($i = 1; $i <= $difference; $i++) {
            $date = $date->addDays(1);

            $data[$date->toDateString()] = [
                'appointment_date'  => strtotime($date->toDateString()) * 1000,
                'sales'       => 0
            ];
        }

        foreach ($carts as $cart) {
            $dateKey = Carbon::createFromTimestamp(strtotime($cart['created_at']))->toDateString();
            $data[$dateKey]['sales'] = $this->getTotalByCart($cart['id']);
        }

        return $this->responseOk(array_values($data));
    }

    private function getTotalByCart($cartId)
    {
        $cartItems = CartItem::where('cart_id', $cartId)->get();
        $total = 0;
return $cartItems;
        foreach ($cartItems as $item) {
            $unitPrice = $item['unit_price'];
            $quantity = $item['quantity'];
            $productDiscount = $item['discount_percentage'] / 100;
            $senior = $item['senior_citizen'];

            $total = $unitPrice * $quantity;

            if ($productDiscount) {
                $discountAmount = $total * $productDiscount;
                $total = $total - $discountAmount;
            }

            if ($senior) {
                $discountAmount = $total * $productDiscount;

                $vat = ($unitPrice / 1.12) * 0.12;
                $unitPrice = $unitPrice - $vat;
                $total = $unitPrice * $quantity;

                $total = $total - $discountAmount;
            }
        }

        return $total;
    }
}