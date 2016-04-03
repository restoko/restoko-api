<?php
namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Carbon\Carbon;

class ProductsController extends ApiController
{
    public function all()
    {
        $products = Product::with('category')->get();

        if ($products->isEmpty()) {
            return $this->responseNotFound(['Products is empty']);
        }

        // Parse Result
        $result = $this->parseProducts($products);

        return $this->responseOk($result);
    }

    public function getByProductId($productId)
    {
        $product = Product::where('id', $productId)->first();

        if (! $product) {
            return $this->responseNotFound('Product not found');
        }

        return $this->responseOk($product);
    }

    public function store(StoreProductRequest $request)
    {
        $input = $request->all();
        unset($input['picture']);

        $destinationPath = public_path('uploads');
        $fileName = uniqid();

        if ($request->file('picture')->isValid()) {
            $request->file('picture')->move($destinationPath, $fileName);
        }

        $input['picture'] = url('uploads').'/'.$fileName;
        $input['slug']= str_replace(' ','_', strtolower($input['name']));

        $product = Product::create($input);

        return $this->createResponse($product);
    }

    public function update(StoreProductRequest $request,$productId)
    {
        $input = $request->all();

        unset($input['picture']);

        $destinationPath = public_path('uploads');
        $fileName = uniqid();

        if ($request->file('picture')->isValid()) {
            $request->file('picture')->move($destinationPath, $fileName);
        }
        print_r($request->file('picture'));exit;
        $input['picture'] = url('uploads').'/'.$fileName;
        $input['slug']= str_replace(' ','_', strtolower($input['name']));

        $product = Product::where('id', $productId)->update($input);

        return $this->createResponse($product);
    }

    public function destroy($productId)
    {
        $product = Product::find($productId)->delete();

        if(! $product)   {
            return $this->responseNotFound(['Product Id not found']);
        }

        return $this->responseOk($product);
    }

    private function parseProducts($products)
    {
        $result = [];
        foreach ($products as $product) {
            $result[] = [
                'id'    => $product['id'],
                'slug'  => $product['slug'],
                'name'  => strtoupper($product['name']),
                'category'  => $product['category']['name'],
                'category_id'   => $product['category_id'],
                'price' => $product['price'],
                'description'   => $product['description'],
                'picture'       => $product['picture'],
                'created_at'    => Carbon::createFromTimestamp(strtotime($product['created_at']))->toFormattedDateString(),
                'updated_at'    => Carbon::createFromTimestamp(strtotime($product['updated_at']))->toFormattedDateString()
            ];
        }

        return $result;
    }

}