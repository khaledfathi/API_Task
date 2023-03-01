<?php

namespace App\Repository; 
use App\Repository\Contracts\UserRepoContract; 
use App\Http\Requests\User\UserStoreRequest;
use App\Rules\UniqueOnChange;
use Illuminate\Http\Request; 
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;
use App\Enums\Status; 
use App\Enums\Types; 


class UserRepo implements UserRepoContract{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  UserModel::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return [ 
            'name',
            'phone',
            'password', 
            'email', 
            'type',
            'status'
        ];  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {  
        return UserModel::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
            'type'=>$request->type,
            'status'=>$request->status
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return UserModel::where('id',$id)->get() ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return UserModel::where('id', $id)->select('id' , 'name','email','password','phone','type','status')->first();
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
                'email'=>['required', 'email',new UniqueOnChange('users',$id)],
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
            return true; 
        }
        return false;  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $found = UserModel::find($id);
        if($found){
            $found->delete();
            return true ;  
        }
        return false ;  
    }
} 