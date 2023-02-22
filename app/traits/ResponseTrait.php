<?php


namespace App\traits;


trait ResponseTrait
{
    public function success($data = null, $message = null , $status = 200){
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ], $status);
    }


    public function failed($data = null , $message = 'error' , $status = 500){
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status'=> $status,

        ], $status);
    }

}
