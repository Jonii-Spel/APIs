<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

$router->get('/users/list',['uses' => 'UserController@index']);
$router->post('/users/create',['uses' => 'UserController@store']);
$router->delete('/users/delete/{id}',['uses' => 'UserController@destroy']);
$router->put('/users/update/{user}',['uses' => 'UserController@update']);
$router->get('/users/show/{id}',['uses' => 'UserController@show']);


