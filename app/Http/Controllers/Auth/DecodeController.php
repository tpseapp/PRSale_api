<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\Permission;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class DecodeController extends Controller
{
    public function tokenDecode(Request $request)
    {
        $token = $request->header('Authorization');
        $credentials = JWT::decode($token, env('JWT_SECRET'), ['HS256']);
        return $this->responseRequestSuccess($credentials);
    }

    protected function responseRequestSuccess($ret)
    {
        return response()->json(['status' => 'success', 'data' => $ret], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
