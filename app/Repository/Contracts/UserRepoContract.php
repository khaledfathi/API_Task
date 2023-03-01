<?php

namespace App\Repository\Contracts;

use App\Http\Requests\User\UserStoreRequest;
use Illuminate\Http\Request; 

interface UserRepoContract{
    public function index(); 
    public function create(); 
    public function store(UserStoreRequest $request); 
    public function show(string $id); 
    public function edit(string $id); 
    public function update(Request $request, string $id); 
    public function destroy (string $id); 

}