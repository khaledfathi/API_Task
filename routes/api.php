<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::resource('user', User::class,);
route::group(['prefix'=>'user'], function (){
    route::get('/',[User::class , 'index']); 
    route::get('{id}',[User::class , 'show']); 
    route::post('create',[User::class , 'create']); 
    route::get('{id}/edit',[User::class , 'edit']); 
    route::post('new',[User::class , 'store']); 
    route::delete('{id}',[User::class , 'destroy']); 
    route::put('{id}',[User::class , 'update']); 
}); 
