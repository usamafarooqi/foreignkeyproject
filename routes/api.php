<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("addmember",[MemberController::class,'store']); //add members
Route::post("addgroup",[GroupController::class,'store']); //add group
Route::get("showmember",[MemberController::class,'show']);
Route::put("update/{id}",[MemberController::class,'update']); //update members
Route::delete("delete/{id}",[MemberController::class,'destroy']);
Route::get("usinggroupid/{id}",[MemberController::class,'usinggroupid']);
Route::get("relationdata/{id}",[MemberController::class,'index']);
Route::get("innerjoin",[MemberController::class,'innerjoin']);
Route::post("register",[AuthController::class,'register']);

Route::post("logout",[AuthController::class,'logout']);
Route::post("upload",[MemberController::class,'upload']);
Route::post("login",[AuthController::class,'login']);