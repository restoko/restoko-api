<?php
namespace App\Http\Requests;

class AuthRequests extends AbstractRequests
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|min:5',
            'password' => 'required|min:3',
        ];
    }

}