<?php
namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreProductRequest;
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

    public function store(StoreProductRequest $request)
    {
        $input= $request->all();
        $input['slug']= str_replace(' ','_', strtolower($input['name']));

        $product = Product::create($input);

        return $this->createResponse($product);
    }

    public function update(StoreProductRequest $request,$productId)
    {
        $input = $request->all();
        $input['slug']= str_replace(' ','_', strtolower($input['name']));

        $product = Product::where('id', $productId)->update($input);

        return $this->createResponse($product);
    }

    public function destroy($productId)
    {
        $product = Category::find($productId)->delete();

        if(! $product)   {
            return $this->responseNotFound(['Product Id not found']);
        }

        return $this->responseOk($product);
    }

}