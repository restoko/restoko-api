<?php
namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;

class ProductsController extends ApiController
{
    public function all()
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return $this->responseNotFound(['Products is empty']);
        }

        return $this->responseOk($products);
    }
}