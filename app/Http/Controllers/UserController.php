<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Enums\Types;
use App\Http\Requests\User\UserStoreRequest;
use App\Repository\Contracts\UserRepoContract;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userProvider; 
    public function __construct(UserRepoContract $userProvider){
        $this->userProvider = $userProvider; 

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records  = $this->userProvider->index(); 
        return view('user.index' , ['records' => $records]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = Status::cases(); 
        $types = Types::cases(); 
        return view ('user.create' , compact('types' , 'status')); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $request->validate(['password' => 'required|confirmed']); 
        $this->userProvider->store($request); 
        return redirect('user'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $record = $this->userProvider->edit($request->id); 
        $types = ['super_admin'=>'Super Admin' , 'admin'=>'Admin'  , 'user'=>'User']; 
        $status = ['active' => 'Active' , 'not_active'=>'Not Active']; 
        return view('user.edit' , compact(['record' , 'types' , 'status']) ); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $this->userProvider->update($request , $request->id );
        return redirect('user'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->userProvider->destroy($request->id); 
        return redirect('user'); 
    }
}
