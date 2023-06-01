<?php


use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Permissions\PermissionUserController;
use App\Http\Controllers\Api\Permissions\ResourceController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register',[RegisterController::class,'store']);
Route::post('/auth',    [AuthController::class, 'auth']);
Route::post('/logout',  [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me',       [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user/can/{permission}',  [PermissionUserController::class, 'userHasPermission']);
    Route::get('/user/{uuid}/permission', [PermissionUserController::class,'permissionUser']);
    Route::post('/user/permission',       [PermissionUserController::class,'addPermissionUser']);
    Route::get('/resources',              [ResourceController::class,'index']);
    Route::apiResource('/user',UserController::class);
});


Route::get('/', function () {
    return response()->json(['message' => 'success']);
});
