<?php

namespace App\Http\Controllers\Api\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Resources\Permissions\MenuResource;
use App\Services\Permissions\ResourceService;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function __construct(protected ResourceService $resourceService) 
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return MenuResource::collection($this->resourceService->all());
    }
}
