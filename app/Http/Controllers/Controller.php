<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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

    public function withPagination($data){

        return response()->json($data) ;
    }
}
