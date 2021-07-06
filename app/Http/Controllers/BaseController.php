<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected function sendResponse(int $code = 200, $data = null, $message = null)
    {
        $data = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($data, $code);
    }
}
