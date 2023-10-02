<?php
namespace App\Http\Controllers;

class AppController extends Controller {
    public function successResponse($data, String $message = '') {
        return response()->json([
            'code' => 200,
            'response' => 'success',
            'data' => $data,
            'message' => $message != '' ? $message : 'Request is success'
        ]);
    }

    public function error404(String $message) {
        return response()->json([
            'code' => 404,
            'response' => 'error',
            'data' => [],
            'message' => $message != '' ?? 'Page is not found'
        ]);
    }
}