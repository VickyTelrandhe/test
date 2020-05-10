<?php

namespace Finoux\DB\services;

use Illuminate\Http\Request;

class BaseService 
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'code' => 200,
            'data'    => $result,
            'message' => $message,
        ];
        return $response;
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'code' => $code,
            'message' => $error,
            'data' => null
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return $response;
    }
}
