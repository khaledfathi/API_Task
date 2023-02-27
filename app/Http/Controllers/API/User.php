<?php

namespace App\Http\Controllers\API;

use App\Enums\Status;
use App\Enums;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Rules\UniqueOnChange;
use Illuminate\Http\Request; 
use App\Models\User as UserModel;
use Illuminate\Validation\Rules\Enum;

class User extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(UserModel::all()); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message'=>'create form', 'status'=>200 ,'form'=>[
            'name',
            'phone',
            'password', 
            'email', 
            'status'
        ]]);  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {  
        UserModel::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'email'=>$request->email,
            'status'=>$request->status
        ]);
        return response()->json(['message'=>'stored', 'status'=>200]);  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(UserModel::where('id',$id)->get()); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rowToEdit = UserModel::where('id', $id)->select('name','email','password','phone','status')->first();
        return response()->json(['message'=>'stored', 'status'=>200 , 'form'=>$rowToEdit , 'hidden'=>['password'=>'xxxxxxxxxx'] ]);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $found = UserModel::find($id); 
        if ($found){
            $request->validate([
                'name'=>['required'],
                'email'=>['required', new UniqueOnChange('users',$id)],
                'password'=>['required', new UniqueOnChange('users',$id)],
                'phone'=>'numeric',
                'status'=>['required', new Enum(Status::class)],
            ]);
            $found->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'password'=>$request->password,
                'email'=>$request->email,
                'status'=>$request->status
            ]);
            return response()->json(['status'=>200, 'update'=>true , 'message'=> 'User has been updated successfully']); 
        }
        return response()->json(['status'=>200, 'update'=>false , 'message'=> 'User does not exist!']); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $found = UserModel::find($id);
        if($found){
            $found->delete();
            return response()->json(["status"=>200 , "delete"=>true ,'message'=>'User has been deleted Successfully']); 
        }
        return response()->json(["status"=>200 , "delete"=>false,'message'=> 'User dose not exist!']); 
    }
}
