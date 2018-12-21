<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * @api {post} /auth/login authenticate yourself to the system
     * @apiPermission None
     * @apiName login
     * @apiParam {string} email your email address
     * @apiParam {string} password your password
     * @apiGroup Auth
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * @api {post} /auth/me fetch currently logged in user info
     * @apiPermission authenticated
     * @apiName Me
     * @apiGroup Auth
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * @api {post} /auth/logout log user out of the system
     * @apiPermission authenticated
     * @apiName logout
     * @apiGroup Auth
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * @api {post} /auth/refresh fetch a new auth token for currently logged-in user
     * @apiPermission authenticated
     * @apiName refresh
     * @apiGroup Auth
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
