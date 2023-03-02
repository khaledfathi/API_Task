<?php

use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Support\Facades\Route;
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


route::post('login' , [UserAuthController::class , 'Login']);

Route::middleware(['auth:sanctum'])->group(function () {
    //users [authorized for <super admin | admin> ]
    route::group(['prefix'=>'user' , 'middleware'=>'auth.superadmin'], function (){
        route::get('/',[UserController::class , 'index']); 
        route::get('{id}',[UserController::class , 'show']); 
        route::post('create',[UserController::class , 'create']); 
        route::get('{id}/edit',[UserController::class , 'edit']); 
        route::post('store',[UserController::class , 'store']); 
        route::delete('{id}',[UserController::class , 'destroy']); 
        route::put('{id}',[UserController::class , 'update']); 
    }); 
    //categories [authorized for <admin> ]
    route::group(['prefix'=>'category' , 'middleware'=>'auth.admin'], function (){
        route::get('/',[CategoryController::class , 'index']); 
        route::get('{id}',[CategoryController::class , 'show']); 
        route::post('create',[CategoryController::class , 'create']); 
        route::get('{id}/edit',[CategoryController::class , 'edit']); 
        route::post('store',[CategoryController::class , 'store']); 
        route::delete('{id}',[CategoryController::class , 'destroy']); 
        route::put('{id}',[CategoryController::class , 'update']); 
    });
    //tasks [authorized for specific <user>]
    route::group(['prefix'=>'task' ], function (){
        route::get('/',[TaskController::class , 'index'])->middleware('auth.admin'); 
        route::get('{id}',[TaskController::class , 'show'])->middleware('auth.admin'); 
        route::post('create',[TaskController::class , 'create'])->middleware('auth.admin'); 
        route::get('{id}/edit',[TaskController::class , 'edit'])->middleware('auth.admin'); 
        route::post('store',[TaskController::class , 'store'])->middleware('auth.admin'); 
        route::delete('{id}',[TaskController::class , 'destroy'])->middleware('auth.admin'); 
        route::put('{id}',[TaskController::class , 'update'])->middleware('auth.user'); 
    }); 
});

//dd
route::get('dd', function (){
    return response()->json('dd'); 

}); 