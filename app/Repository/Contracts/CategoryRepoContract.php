<?php 

namespace App\Repository\Contracts;
use App\Http\Requests\Category\CategoryStoreRequest;
use Illuminate\Http\Request;

interface CategoryRepoContract{
    public function index(); 
    public function create(); 
    public function store(CategoryStoreRequest $request); 
    public function show(string $id); 
    public function edit(string $id); 
    public function update(Request $request, string $id); 
    public function destroy(string $id); 
}    
