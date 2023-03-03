<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\TaskStoreRequest;
use App\Http\Requests\Task\TaskRequest;
use App\Models\TaskModel;
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
    public function store(TaskRequest $request)
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
    public function update(TaskRequest $request, string $id)
    {
        //validate the current user has permission to manage this task
        $isAssignToUser = TaskModel::where('id', $id )->where('assignee_id' , auth()->user()->id)->count(); 
        if ( $isAssignToUser && auth()->user()->type == 'user'){
            return response()->json(['message'=>'This task is not assign to the current user!' ,'status'=>403 , 'is'=>$isAssignToUser]);  
        }
        //prevent normal users from set task as [rejected or success]
        if (in_array($request->status,['rejected', 'success']) && auth()->user()->type == 'user'){

            return response()->json(['message'=>'only super admin or admin users can set [\'rejected\' or \'success\']' ,'status'=>202 ]);  
        }
        //prevent change [creator_id , assignee_id , category_id]
        if ( ($request->has('assignee_id') || $request->has('creator_id') || $request->has('category_id')) && auth()->user()->type == 'user' ){
            return response()->json(['message'=>'only super admin or admin can moidify [creator_id , assignee_id , category_id]!' ,'status'=>202 ]);  
        }
        //start updating if record exist
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
