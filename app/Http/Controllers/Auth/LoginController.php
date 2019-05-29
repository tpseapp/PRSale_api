<?php

namespace App\Http\Controllers\Auth;

use App\Member;
use App\Permission;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class LoginController extends Controller
{
    public function getMember()
    {
        $tbl_member = Member::all();
        return $tbl_member;
    }

    public function getMemberToken()
    {
        //echo 'null';
        $tbl_member  = Member::all();
        //return $this->responseRequestSuccess($tbl_member);
        foreach ($tbl_member as $key => $value) {
            echo $value->id_data_role;
            echo "<br>";

            if ($value->token_member) {
                echo "มีการล็อกอิน";
                echo "<br>";
            } else {
                echo "ไม่มีการล็อกอิน";
                echo "<br>";
            }
        }
    }

    public function login(Request $request)
    {
        //$tbl_member  = Member::with('mod_employee')->where('user_member', $request->username)->first();

        $tbl_member = Member::where('user_member', $request->username)->first();

        if ($tbl_member) {

            if ($tbl_member->id_data_role) {

                if (!$tbl_member->token_member) {

                    if ((password_verify($request->password, $tbl_member->pass_member))) {

                        $token = $this->jwt($tbl_member);
                        //$tbl_member["api_token"] = $token;

                        $tbl_member->token_member = $token;
                        $tbl_member->save();
                        //sessionsTokenMember($token , $tbl_member->id_member);
                        return $this->responseRequestSuccess($tbl_member);
                    } else {
                        return $this->responseRequestError("รหัสผ่านของไม่ถูกต้อง !");;
                    }
                } else {
                    return $this->responseRequestError("ชื่อผู้ใช้งาน นี้มีการเข้าสู่ระบบ อยู่ !");
                }
            } else {
                return $this->responseRequestError("ไม่สามารถใช้ บัญชี นี้เข้าระบบได้ !");
            }
        } else {
            return $this->responseRequestError("ไม่พบชื่อผู้ใช้งาน !");
        }


        //return $tbl_member;
    }

    public function Logout(Request $request)
    {
        $tbl_member = Member::where('token_member', $request->token_member)->first();
        $tbl_member->token_member = "";
        $tbl_member->save();

        return $this->responseRequestSuccess("logout");
    }

    protected function jwt($tbl_member)
    {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $tbl_member->username, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + env('JWT_EXPIRE_HOUR') * 60 * 60, // Expiration time
        ];
        return JWT::encode($payload, env('JWT_SECRET'));
    }

    protected function responseRequestSuccess($ret)
    {
        return response()->json(['status' => 'success', 'data' => $ret], 200)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }

    protected function responseRequestError($message = 'Bad request', $statusCode = 200)
    {
        return response()->json(['status' => 'error', 'error' => $message], $statusCode)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    }
}
