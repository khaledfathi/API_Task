<?php

namespace App\Repository; 
use App\Repository\Contracts\UserRepoContract; 
use App\Http\Requests\User\UserStoreRequest;
use App\Rules\UniqueOnChange;
use Illuminate\Http\Request; 
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class UserRepo implements UserRepoContract{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $found = UserModel::all();
        if ($found->count()){
            return ['message'=>'users found', 'status'=>200 ,'user_count'=>$found->count(), 'users'=>$found]; 
        }
        return ['message'=>'there is no user registered yet!' , 'status'=>200]; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ['message'=>'create form', 'status'=>200 ,'form'=>[
            'name',
            'phone',
            'password', 
            'email', 
            'type',
            'status'
        ]];  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {  
        $record = UserModel::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'type'=>$request->type,
            'status'=>$request->status
        ]);
        return ['message'=>'stored', 'record_id'=>$record->id,'status'=>200];  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $found =UserModel::where('id',$id)->get() ;
        if ($found->count()){
            return ['message'=>"user found" , 'status'=>200 , 'user'=>$found ];
        }
        return ['message'=>"user ID : '$id' does not exist!" , 'status'=>200 , 'user'=>$found ]; 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rowToEdit = UserModel::where('id', $id)->select('name','email','password','phone','type','status')->first();
        return ['message'=>'user edit form', 'status'=>200 , 'form'=>$rowToEdit , 'hidden'=>['password'=>'xxxxxxxxxx'] ];  
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
                'password'=>'required',
                'phone'=>'numeric',
                'type'=>['required', new Enum(Types::class)],
                'status'=>['required', new Enum(Status::class)],
            ]);
            $found->update([
                'name'=>$request->name,
                'phone'=>$request->phone,
                'password'=>Hash::make($request->password),
                'email'=>$request->email,
                'type'=>$request->type,
                'status'=>$request->status
            ]);
            return ['status'=>200, 'update'=>true , 'message'=> 'User has been updated successfully']; 
        }
        return ['status'=>200, 'update'=>false , 'message'=> 'User does not exist!']; 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $found = UserModel::find($id);
        if($found){
            $found->delete();
            return ["status"=>200 , "delete"=>true ,'message'=>'User has been deleted Successfully']; 
        }
        return ["status"=>200 , "delete"=>false,'message'=> 'User dose not exist!']; 
    }
} 