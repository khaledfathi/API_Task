<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Repository\Contracts\UserRepoContract;
use Illuminate\Http\Request; 

class UserController extends Controller
{
    private $userProvider ; 
    public function __construct(UserRepoContract $userProvider){
        $this->userProvider =$userProvider; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $found = $this->userProvider->index();
        if ($found->count()){
            return ['message'=>'users found', 'status'=>200 ,'user_counts'=>$found->count(), 'users'=>$found]; 
        }
        return ['message'=>'there is no user registered yet!' , 'status'=>204 , 'user_counts'=>0,  'users'=>[]]; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message'=>'create form', 'status'=>200 ,'form'=>$this->userProvider->create()]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {  
        return response()->json(['message'=>'stored' , 'status'=>201 , 'record'=> $this->userProvider->store($request) , 'hashed'=>['password'=>'xxxxxxxx']]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $found = $this->userProvider->show($id); 
        if ($found->count()){
            return ['message'=>"user found" , 'status'=>200 , 'user'=>$found ];
        }
        return ['message'=>"user ID : '$id' does not exist!" , 'status'=>204 , 'user'=>$found ]; 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return response()->json($this->userProvider->edit($id)); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($this->userProvider->update($request , $id)){
            return response()->json(['message'=>'updated succesfuly' , 'status'=>202]); 
        }
        return response()->json(['message'=>"user ID $id does not exist!" , 'status'=>204]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->userProvider->destroy($id)){
            return response()->json(['message'=>'deleted successfuly' , 'status'=>202]); 
        } 
        return response()->json(['message'=>"user ID $id does not exist!" , 'status'=>204]); 
    }
}
