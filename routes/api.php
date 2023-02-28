<?php

use App\Http\Controllers\API\UserAuth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\User;
use App\Http\Controllers\API\Category;
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


route::post('login' , [UserAuth::class , 'Login']);

Route::middleware(['auth:sanctum'])->group(function () {
    //users
    route::group(['prefix'=>'user'], function (){
        route::get('/',[User::class , 'index']); 
        route::get('{id}',[User::class , 'show']); 
        route::post('create',[User::class , 'create']); 
        route::get('{id}/edit',[User::class , 'edit']); 
        route::post('new',[User::class , 'store']); 
        route::delete('{id}',[User::class , 'destroy']); 
        route::put('{id}',[User::class , 'update']); 
    }); 
    //categories
    route::group(['prefix'=>'category'], function (){
        route::get('/',[Category::class , 'index']); 
        route::get('{id}',[Category::class , 'show']); 
        route::post('create',[Category::class , 'create']); 
        route::get('{id}/edit',[Category::class , 'edit']); 
        route::post('new',[Category::class , 'store']); 
        route::delete('{id}',[Category::class , 'destroy']); 
        route::put('{id}',[Category::class , 'update']); 
    }); 
});

//dd
route::get('dd', function (){
    return response()->json('dd'); 

}); 