<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreCategoryRequest;
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

    public function store(StoreCategoryRequest $request)
    {
        $input = $request->all();
        $input['slug'] = str_replace(' ', '_', strtolower($input['name']));

        $category = Category::create($input);

        return $this->createResponse($category);
    }

    public function update(StoreCategoryRequest $request, $categoryId)
    {
        $input = $request->all();
        $input['slug'] = str_replace(' ', '_', strtolower($input['name']));

        $category = Category::where('id', $categoryId)->update($input);

        return $this->createResponse($category);
    }

    public function destroy($categoryId)
    {
        $category = Category::find($categoryId)->delete();

        if (! $category) {
            return $this->responseNotFound(['Category Id not found']);
        }

        return $this->responseOk($category);
    }
}