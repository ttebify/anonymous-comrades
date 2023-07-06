<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    /**
     * Return generic json response with the given data.
     *
     * @param  int  $statusCode
     * @param  array  $headers
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($data, $statusCode = Response::HTTP_OK, $headers = [])
    {
        return response()->json($data, $statusCode, $headers);
    }

    /**
     * Respond with success.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondSuccess()
    {
        return $this->respond(null);
    }

    /**
     * Respond with created.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondCreated($data)
    {
        return $this->respond($data, Response::HTTP_CREATED);
    }

    /**
     * Respond with no content.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNoContent()
    {
        return $this->respond(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Respond with error.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondError($message, $statusCode)
    {
        return $this->respond([
            'errors' => [
                'message' => $message,
                'status_code' => $statusCode,
            ],
        ], $statusCode);
    }

    /**
     * Respond with unauthorized.
     *
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->respondError($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Respond with forbidden.
     *
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respondError($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Respond with not found.
     *
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondNotFound($message = 'Not Found')
    {
        return $this->respondError($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * Respond with failed login.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondFailedLogin()
    {
        return $this->respond([
            'errors' => [],
            'message' => 'email or password is invalid',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Respond with internal error.
     *
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondInternalError($message = 'Something went wrong with the request. Our engineers are aware of it and are working to fix it.')
    {
        return $this->respondError($message, Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
