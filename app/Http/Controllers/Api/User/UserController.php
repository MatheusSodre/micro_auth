<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUpdateUser;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(protected UserService $userService)
    {
        
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection($this->userService->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateUser $request)
    {
        return  new UserResource($this->userService->store($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return new UserResource($this->userService->getByUuid($uuid));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateUser $request, string $id)
    {
        return $this->userService->update($request->validated(),$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->userService->destroy($id);
    }
}
