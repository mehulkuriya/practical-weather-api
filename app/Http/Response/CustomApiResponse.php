<?php

namespace App\Http\Response;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response as ResponseHTTP;

class CustomApiResponse
{
    /**
     * Function for generating API response
     * @param string $success
     * @param string $payload
     * @param string $message
     *
     * @return array
     */
    public function getResponseStructure($success = false, $payload = null, $message = '')
    {
         if (!empty($success) && !empty($payload)) {
            $data = [
                'message' => $message,
                'data' => $payload
            ];
        } elseif ($success) {
            $data = [
                'message' => $message,
                
            ];
        } else {
            $data = [
                'error' => [
                     $message,
                ]
            ];
        }

        return $data;
    }

    /**
     * handle all type of exceptions
     * @param \Exception $ex
     * @return mixed|string
     */
    public function handleAndResponseException(\Exception $ex)
    {
        $response = '';
        switch (true) {
            case $ex instanceof ModelNotFoundException:
                $response = response()->json(['message' => $ex->getMessage()], ResponseHTTP::HTTP_NOT_FOUND);
                break;
            case $ex instanceof QueryException:
                $response = response()->json(['message' => $ex->getMessage()], ResponseHTTP::HTTP_BAD_REQUEST);
                break;
            case $ex instanceof HttpResponseException:
                $response = response()->json(['message' => $ex->getMessage()], ResponseHTTP::HTTP_INTERNAL_SERVER_ERROR);
                break;
            case $ex instanceof \Exception:
                $response = response()->json(['message' => $ex->getMessage()], ResponseHTTP::HTTP_INTERNAL_SERVER_ERROR);
                break;
        }
        return $response;
    }
}
