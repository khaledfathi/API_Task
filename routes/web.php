<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


route::get('/',[HomeController::class , 'HomePage']); 
route::get('diagrams',[HomeController::class , 'DiagramsPage']); 

//category
route::group(['prefix'=>'category'], function (){
    route::get('' , [CategoryController::class , 'index']); 
    route::get('create' , [CategoryController::class , 'create']); 
    route::get('store' , [CategoryController::class , 'store']); 
    route::get('destroy' , [CategoryController::class , 'destroy']); 
    route::get('edit', [CategoryController::class , 'edit']); 
    route::get('update', [CategoryController::class , 'update']); 
}); 
//users
route::group(['prefix'=>'user'], function (){
    route::get('' , [UserController::class , 'index']); 
    route::get('destroy' , [UserController::class , 'destroy']); 
    route::get('create' , [UserController::class , 'create']); 
    route::post('store' , [UserController::class , 'store']); 
    route::get('edit' , [UserController::class , 'edit']); 
    route::get('update' , [UserController::class , 'update']); 
}); 
//users
route::group(['prefix'=>'task'], function (){
    route::get('' , [TaskController::class , 'index']); 
    route::get('create' , [TaskController::class , 'create']); 
    route::get('store' , [TaskController::class , 'store']); 
    route::get('destroy' , [TaskController::class , 'destroy']); 
    route::get('edit' , [TaskController::class , 'edit']); 
    route::get('update' , [TaskController::class , 'update']); 
}); 