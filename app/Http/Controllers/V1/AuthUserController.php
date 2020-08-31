<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthUserController extends BaseController {
    //
    /**
     * @var JWTAuth
     */
    private $jwtAuth;

    protected $guard = 'user';
    protected $maxAttempts = 5;
    protected $decayMinutes = 5;
    use AuthenticatesUsers;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwtAuth) {
        $this->middleware('auth:' . $this->guard, ['except' => ['login']]);
        $this->jwtAuth = $jwtAuth;
    }

    public function formatToken($token) {
        $response = [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth($this->guard)->factory()->getTTL() * 1000000,
        ];

        return $response;
    }

    public function login(Request $request) {
        $data = $request->all();

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return response()->json(['message' => 'Too many logins, Please wait for 5 mins'], 400);
        }
        try {
            if (! $token = auth($this->guard)->attempt($data)) {
                $this->incrementLoginAttempts($request);
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
          } catch (JWTException $e) {
            $this->incrementLoginAttempts($request);
            return response()->json(['error' => 'Could Not Create Token'], 500);
          }
        
        return response()->json(['access_token' => $token], 201);
       
    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {

        auth($this->guard)->logout();

        return customResponse(204, 'Successfully logged out', [], true);

    }

    public function refresh() {
        return showResponse($this->formatToken(auth($this->guard)->refresh()));
    }


}
