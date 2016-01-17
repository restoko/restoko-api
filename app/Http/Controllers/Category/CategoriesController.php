<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\Category;

class CategoriesController extends ApiController
{
    public function all()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return $this->responseNotFound(['Categories is empty']);
        }

        return $this->responseOk($categories);
    }
}