<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Repository\Contracts\TaskRepoContract;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    private $taskProvider ; 
    public function __construct( TaskRepoContract $taskProvider){
        $this->taskProvider = $taskProvider; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $found = $this->taskProvider->index(); 
        if ($found->count()){

            return response()->json(['message'=>'tasks found' , 'status'=>200 , 'tasks'=>$this->taskProvider->index()]); 
        }
        return response()->json(['message'=>'there is no tasks yet!' , 'status'=>204 , 'tasks'=>[]]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message'=>'create form' , 'status'=>200 , 'form'=>$this->taskProvider->create()]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request)
    {
        return response()->json(['message'=>'stored' ,'status'=>201 , 'record'=>$this->taskProvider->store($request)]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $found = $this->taskProvider->show($id); 
        if($found->count()){
            return response()->json(['message'=>'task found' , 'status'=>200 , 'task'=>$found]); 
        }; 
        return response()->json(['message'=>"task ID $id does not exist!" , 'status'=>204 , 'task'=>[]]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $found = $this->taskProvider->edit($id); 
        if($found){
            return response()->json(['message'=>'task found' , 'status'=>200 , 'record'=>$found]); 
        }
        return response()->json(['message'=>"task ID $id does not exist!" , 'status'=>204 , 'task'=>[]]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskStoreRequest $request, string $id)
    {
        $found = $this->taskProvider->update($request , $id); 
        if ($found){
            return response()->json(['message'=>'updated successfuly' ,'status'=>202 ]);  
        }
        return response()->json(['message'=>"task ID $id does not exist!" ,'status'=>204 ]); 
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->taskProvider->destroy($id) ){
            return response()->json(['message'=>'deleted succsessfuly' , 'status'=>202]); 
        }
        return response()->json(['message'=>"task ID $id does not exist!" , 'status'=>204]); 

    }
}