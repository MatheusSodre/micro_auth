<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUser;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function auth(AuthUser $request)
    {   
        return $this->userService->getByEmail($request->validated());
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'logout' => 'success'
        ]);
        
    }
    public function me(Request $request)
    {
        $user = $request->user();
        return new UserResource($user);
    }
}
