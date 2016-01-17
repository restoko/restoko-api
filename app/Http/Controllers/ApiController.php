<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;

abstract class ApiController extends Controller
{
    /**
     * @var int
     */
    protected $status;

    /**
     * Status setter
     *
     * @param $status
     * @return $this
     */
    protected function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Main response
     *
     * @param $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function apiResponse($data)
    {
        return response()->json($data, $this->status);
    }

    /**
     * Response with 200
     *
     * @param $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function responseOk($data)
    {
        $data = [
            'data'      => $data,
            'status'    => HttpResponse::HTTP_OK
        ];

        return $this->setStatus(HttpResponse::HTTP_OK)
            ->apiResponse($data);
    }

    /**
     * Response with created status
     *
     * @param $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function responseCreated($data)
    {
        $data = [
            'data'      => $data,
            'status'    => HttpResponse::HTTP_CREATED
        ];

        return $this->setStatus(HttpResponse::HTTP_CREATED)
            ->apiResponse($data);
    }

    protected function responseFound($data)
    {
        $data = [
            'data'      => $data,
            'status'    => HttpResponse::HTTP_FOUND
        ];

        return $this->setStatus(HttpResponse::HTTP_FOUND)
            ->apiResponse($data);
    }

    /**
     * Response with not found
     *
     * @param string $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function responseNotFound($message = 'The requested resource is not found')
    {
        $data = [
            'status'    => HttpResponse::HTTP_NOT_FOUND,
            'message'   => $message
        ];

        return $this->setStatus(HttpResponse::HTTP_NOT_FOUND)
            ->apiResponse($data);
    }

    /**
     * Response with forbidden
     *
     * @param string $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function responseForbidden($message = 'You are forbidden to access the requested resource')
    {
        $data = [
            'status'    => HttpResponse::HTTP_FORBIDDEN,
            'message'   => $message
        ];

        return $this->setStatus(HttpResponse::HTTP_FORBIDDEN)
            ->apiResponse($data);
    }

    /**
     * Unauthorized request
     *
     * @param string $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function responseUnauthorized($message = 'Unauthorized')
    {
        $data = [
            'status'    => HttpResponse::HTTP_UNAUTHORIZED,
            'message'   => $message
        ];

        return $this->setStatus(HttpResponse::HTTP_UNAUTHORIZED)
            ->apiResponse($data);
    }

    /**
     * Response with error
     *
     * @param $error
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function responseBadRequest($error = [], $message = 'Bad Request')
    {
        $data = [
            'status'    => HttpResponse::HTTP_BAD_REQUEST,
            'message'   => $message,
            'errors'    => $error
        ];

        return $this->setStatus(HttpResponse::HTTP_BAD_REQUEST)
            ->apiResponse($data);
    }

    /**
     * Response with error entity
     *
     * @param $error
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function responseUnproccessedEntity($error, $message = 'Unproccessable Entity')
    {
        $data = [
            'status'    => HttpResponse::HTTP_UNPROCESSABLE_ENTITY,
            'message'   => $message,
            'errors'    => $error
        ];

        return $this->setStatus(HttpResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->apiResponse($data);
    }

    /**
     * Helper function for normal responses of controllers
     *
     * @param $response
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function createResponse($response, $badRequestMessage = ['An error occurred while processing your request'])
    {
        // Check validation errors
        if (isset($response['errors'])) {
            return $this->responseUnproccessedEntity($response['errors']);
        }
        // Check more errors
        if (! $response) {
            return $this->responseBadRequest($badRequestMessage);
        }
        // Response created
        return $this->responseCreated($response);
    }
}