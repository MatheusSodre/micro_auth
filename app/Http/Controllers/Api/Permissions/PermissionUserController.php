<?php

namespace App\Http\Controllers\Api\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permissions\StorePermission;
use App\Http\Resources\Permissions\PermissionResource;
use App\Http\Resources\User\UserResource;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    public function __construct(protected UserService $userService) 
    {    
    }

    /**
     * Display a listing of the resource.
     */
    public function permissionUser($uuid)
    {
        return new UserResource($this->userService->permissionUser($uuid));
    }
    public function addPermissionUser(StorePermission $request)
    {
        return $this->userService->addPermissionUser($request);
    }
    public function userHasPermission(Request $request,$permission)
    {
        return $this->userService->userHasPermission($request->user(),$permission);
    }
}
