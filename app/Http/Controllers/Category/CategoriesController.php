<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Carbon\Carbon;

class CategoriesController extends ApiController
{
    public function all()
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return $this->responseNotFound(['Categories is empty']);
        }

        $categories = $this->parseCategories($categories);

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

    private function parseCategories($categories)
    {
        $result = [];
        foreach ($categories as $category) {
            $result[] = [
                'id'    => $category['id'],
                'slug'  => $category['slug'],
                'name'  => strtoupper($category['name']),
                'description'   => $category['description'],
                'created_at'    => Carbon::createFromTimestamp(strtotime($category['created_at']))->toFormattedDateString(),
                'updated_at'    => Carbon::createFromTimestamp(strtotime($category['updated_at']))->toFormattedDateString()
            ];
        }

        return $result;
    }
}