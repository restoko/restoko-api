<?php
namespace App\Http\Requests;

abstract class AbstractRequests extends Request
{
    /**
     * Authorize all requests
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Error response for 422
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response(array $errors)
    {
        $response['status'] = 422;
        $response['errors'] = $errors;

        return response()->json($response, 422);
    }
}