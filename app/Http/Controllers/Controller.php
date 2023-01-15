<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result , $message)
    {
        $response = [
            'status' => true, 
            'message' => $message, 
        ];
        if (!empty($result)) {
            $response['data'] = $result;
        }
        return response()->json($response, 200);
    }
    public function sendResponseNew($data , $message)
    {
        return response()->json(['response' => $data, 'metadata' => $message], 200);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'status' => false,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    public function sendErrorNew($errorMessage, $errorData = [])
    {
        if (!empty($errorData)) {
            $errorMessage['data'] = $errorData;
        }
        return response()->json(['metadata' => $errorMessage]);
    }
    public function sendErrorTrsNew($errorMessage, $errorData = [])
    {
       
        return response()->json(['response' => $errorMessage, 'metadata' => $errorData],201);
    }
}
