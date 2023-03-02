<?php

namespace App\Repository;

use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use App\Repository\Contracts\TaskRepoContract;
use App\Models\TaskModel;

class TaskRepo implements TaskRepoContract
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TaskModel::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return [
            'title',
            'desctiption',
            'start_date',
            'end_date',
            'assign_at',
            'status',
            'priority',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        return TaskModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'assign_at' => $request->assign_at,
            'status' => $request->status,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
            'creator_id' => $request->creator_id,
            'assignee_id' => $request->assignee_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return TaskModel::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return TaskModel::where('id', $id)->select(
            'id',
            'title',
            'description',
            'start_date',
            'end_date',
            'assign_at',
            'status',
            'priority',
            'creator_id',
            'assignee_id',
            'category_id'
        )->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, string $id)
    {
        $found = TaskModel::where('id', $id);
        if ($found->count()) {
            $found->update([
                'title' => $request->title,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'assign_at' => $request->assign_at,
                'status' => $request->status,
                'priority' => $request->priority,
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
        $found = TaskModel::where('id', $id);
        if ($found->count()) {
            $found->delete();
            return true;
        }
        return false;
    }
}