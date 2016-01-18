<?php
namespace App\Http\Requests;

class StoreProductRequest extends AbstractRequests
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3',
            'price'=> 'required|numeric',
            'description'=>'required|min:5',
        ];
    }
}
