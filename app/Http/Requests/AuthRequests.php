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
            'email' => 'required|min:5|email',
            'password' => 'required|min:3',
        ];
    }

}