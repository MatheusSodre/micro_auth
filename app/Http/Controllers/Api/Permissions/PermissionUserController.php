<?php

namespace App\Http\Controllers\Api\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permissions\PermissionResource;
use Illuminate\Http\Request;

class PermissionUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function permissionUser(Request $request)
    {
        $permissions =  $request->user()->permissions()->get(); 
        return PermissionResource::collection($permissions);
    }

}
