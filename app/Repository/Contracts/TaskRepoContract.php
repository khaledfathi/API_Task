<?php

namespace App\Repository\Contracts;
use App\Http\Requests\Task\TaskRequest;
use App\Http\Requests\Task\TaskUpdateRequest;
use Illuminate\Http\Request; 

interface TaskRepoContract{
    public function index(); 
    public function create(); 
    public function store(TaskRequest $request); 
    public function show(string $id); 
    public function edit(string $id); 
    public function update(TaskRequest $request, string $id); 
    public function destroy (string $id); 

}