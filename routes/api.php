<?php

use App\Http\Controllers\CustomerController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::post('customers/register', [CustomerController::class, 'store']);
Route::middleware('auth:sanctum')->get('customers/', [CustomerController::class, 'index']);
Route::middleware('auth:sanctum')->get('customers/{customer}', [CustomerController::class, 'show']);
Route::middleware('auth:sanctum')->put('customers/{customer}', [CustomerController::class, 'update']);

Route::post('/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    $response = [
        'user' => $user,
        'token' => $token,
    ];

    return response($response, 201);
});

Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->tokens()->delete();

    return response('Loggedout', 200);
});
