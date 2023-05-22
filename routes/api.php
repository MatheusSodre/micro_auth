<?php


use App\Http\Controllers\Api\Evaluation\EvaluationController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Support\Facades\Route;

Route::apiResource('user',UserController::class);

Route::get('/', function () {
    return response()->json(['message' => 'success']);
});
