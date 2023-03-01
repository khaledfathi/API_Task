<?php

namespace App\Repository\Contracts;

use Illuminate\Http\Request; 
use App\Http\Requests\User\UserStoreRequest;

interface UserRepoContract{
    public function index(); 
    public function create(); 
    public function store(UserStoreRequest $request); 
    public function show(string $id); 
    public function edit(string $id); 
    public function update(Request $request, string $id); 
    public function destroy (string $id); 

}