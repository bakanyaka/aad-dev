<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    /**
     * @var JWTAuth
     */
    protected $auth;

    /**
     * AuthController constructor.
     * @param JWTAuth $auth
     */
    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function login(LoginFormRequest $request)
    {
        try {
            if (!$token = $this->auth->attempt($request->only('username', 'password'))) {
                return response()->json([
                    'errors' => [
                        'root' => 'Неверное имя пользователя или пароль. Проверьте правильность введенных данных'
                    ]
                ], 401);

            }
        } catch (JWTException $e) {
            return response()->json([
                'errors' => [
                    'root' => 'Ошибка при формировании токена'
                ]
            ], 500);
        }
        return response()->json([
            'data' => $request->user(),
            'meta' => [
                'token' => $token
            ]
        ], 200);
    }

    public function logout()
    {
        $this->auth->invalidate($this->auth->getToken());
        return response(null, 200);
    }

    public function user(Request $request)
    {
        return response()->json([
           'data' => $request->user()
        ]);
    }

}
