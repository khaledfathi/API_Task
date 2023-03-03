<?php

namespace App\Http\Controllers;

use App\Enums\Priority;
use App\Enums\Status;
use App\Enums\TaskStatus;
use App\Enums\Types;
use App\Http\Requests\Task\TaskRequest;
use App\Models\CategoryModel;
use App\Models\TaskModel;
use App\Models\User as UserModel;
use App\Repository\Contracts\TaskRepoContract;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskProvider; 
    public function __construct(TaskRepoContract $taskProvider){
        $this->taskProvider = $taskProvider; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = TaskModel::leftJoin('categories' , 'tasks.category_id' , '=' , 'categories.id')->
            leftJoin('users as users_creator' , 'tasks.creator_id' ,'=' , 'users_creator.id')->
            leftJoin('users as users_assignee' , 'tasks.assignee_id' , '=' , 'users_assignee.id')->
            select(
                'tasks.id',
                'tasks.title',
                'tasks.description',
                'tasks.start_date',
                'tasks.end_date',
                'tasks.assign_at',
                'tasks.status as task_status',
                'tasks.priority',
                'users_creator.name as creator',
                'users_assignee.name as assignee',
                'categories.title as category_title'
                )->orderBy('tasks.id' , 'desc')->get();             
        return view('task.index' , ['records'=> $records ]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = CategoryModel::select('id' , 'title')->get(); 
        $users = UserModel::select('id' , 'name')->get(); 
        $types = Types::cases(); 
        $priority = Priority::cases(); 
        $status = TaskStatus::cases(); 
        return view('task.create' , compact('categories' , 'users' , 'status' ,'priority', 'types'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $this->taskProvider->store($request) ; 
        return redirect('task'); 
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
        $categories = CategoryModel::select('id' , 'title')->get(); 
        $users = UserModel::select('id' , 'name')->get(); 
        $types = Types::cases();
        $priority = Priority::cases();
        $status = TaskStatus::cases();
        $record = TaskModel::leftJoin('categories' , 'tasks.category_id' , '=' , 'categories.id')->
            leftJoin('users as users_creator' , 'tasks.creator_id' ,'=' , 'users_creator.id')->
            leftJoin('users as users_assignee' , 'tasks.assignee_id' , '=' , 'users_assignee.id')->
            select(
                'tasks.id',
                'tasks.creator_id',
                'tasks.assignee_id',
                'tasks.category_id',
                'tasks.title',
                'tasks.description',
                'tasks.start_date',
                'tasks.end_date',
                'tasks.assign_at',
                'tasks.status as task_status',
                'tasks.priority',
                'users_creator.name as creator',
                'users_assignee.name as assignee',
                'categories.title as category_title',
                )->where('tasks.id' , $request->id)->orderBy('tasks.id' , 'desc')->first(); 
        return view('task.edit' , compact('record' , 'categories' , 'users' , 'status' ,'priority', 'types'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request)
    {
        $this->taskProvider->update($request , $request->id);
        return redirect('task'); 
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->taskProvider->destroy($request->id); 
        return redirect('task'); 
    }
}
