<?php

namespace App\Repository\Contracts;
use App\Http\Requests\Task\TaskStoreRequest;
use Illuminate\Http\Request; 

interface TaskRepoContract{
    public function index(); 
    public function create(); 
    public function store(TaskStoreRequest $request); 
    public function show(string $id); 
    public function edit(string $id); 
    public function update(TaskStoreRequest $request, string $id); 
    public function destroy (string $id); 

}