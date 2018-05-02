<?php

namespace Adtech\Api\App\Http\Controllers\Auth;

use Adtech\Application\Cms\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class RegisterController extends Controller
{
    public function create(Request $request)
    {
        $response['status'] = 'RESULT_NOT_OK';
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $response['error'] = 'user_not_found';
                return response()->json($response, 404);
            }
        } catch (TokenExpiredException $e) {
            $response['error'] = 'token_expired';
            return response()->json($response, $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            $response['error'] = 'token_invalid';
            return response()->json($response, $e->getStatusCode());
        } catch (JWTException $e) {
            $response['error'] = 'token_absent';
            return response()->json($response, $e->getStatusCode());

        }

        $response['status'] = 'RESULT_OK';
        $response['data'] = compact('user');
        // all good so return the token
        return response()->json($response);
    }
}