<?php

namespace Adtech\Api\App\Http\Controllers\Auth;

use Tymon\JWTAuth\Exceptions\JWTException;
use Adtech\Application\Cms\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        $response = [
            'status' => 'RESULT_NOT_OK',
        ];
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                $response['error'] = 'invalid_credentials';
                return response()->json($response, 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            $response['error'] = 'could_not_create_token';
            return response()->json($response, 500);
        }

        $response['status'] = 'RESULT_OK';
        $response['data'] = compact('token');
        // all good so return the token
        return response()->json($response);
    }

    public function verify(Request $request)
    {

    }
}