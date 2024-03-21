<?php

namespace App\Http\Controllers\Auth\Api;

use App\Http\Controllers\Controller;
use App\Services\IntroduceService;
use App\Services\Traits\AuthenticatesUsers;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class RegisterController extends Controller
{
    protected UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'password' => 'required|string',
        ]);

        $requester = $request->all();
        $requester['password'] = Hash::make($request->password);

        $user = $this->userService->create($requester);

        if ($request->has('ref')) {
            $userByRef = $this->userService->findBy(['code' => $request->ref])->first();
        }

        return $this->sendResponse($user, 'User register successfully', ResponseAlias::HTTP_CREATED);
    }
}
