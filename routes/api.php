<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\MobileUserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/send/{room}', [MessageController::class, 'sendMessage']);
Route::get('/test', [MessageController::class, 'test']);
Route::post('/create_room/{mobile_user}', [RoomController::class, 'create_room']);
Route::post('/accept_room', [RoomController::class, 'accept_room_invitation']);
Route::post('/register', [MobileUserController::class, 'register']);
Route::post('/update', [MobileUserController::class, 'update']);
Route::get('/rooms/{user}', [MobileUserController::class, 'user_rooms']);
Route::post('/login', [MobileUserController::class, 'login']);
