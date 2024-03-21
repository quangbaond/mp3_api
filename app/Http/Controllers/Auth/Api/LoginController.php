<?php

namespace App\Http\Controllers\Auth\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\Traits\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Handle a login request to the application.
     *
     * @throws ValidationException
     */
    public function login(Request $request): UserResource | ValidationException
    {
        $token = $this->attemptLogin($this->credentials($request), false, true);
        if (!$token) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        return $this->respondWithToken($token);
        // $request->validate([
        //     'user_name' => 'required|string',
        //     'password' => 'required|string',
        // ]);
        // $credentials = $request->only('user_name', 'password');

        // $token = Auth::attempt($credentials);
        // if (!$token) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Unauthorized',
        //     ], 401);
        // }

        // return $this->respondWithToken($token);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param $token
     *
     * @return UserResource
     */
    protected function respondWithToken($token): UserResource
    {
        $user = $this->guard()->user();

        if (empty($user)) {
            abort(401);
        }


        return (new UserResource($user))
            ->withToken($token, $this->guard()->factory()->getTTL() * config('jwt.refresh_ttl'));
    }
}
