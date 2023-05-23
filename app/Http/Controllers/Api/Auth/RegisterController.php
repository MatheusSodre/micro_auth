<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUser;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUser $request)
    {
        $user = $this->userService->store($request->validated());
        return (new UserResource($user))->additional(['token' => $user->createToken($request->device_name)->plainTextToken]);
    }
}
