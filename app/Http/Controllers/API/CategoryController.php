<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Repository\Contracts\CategoryRepoContract;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryProvider; 
    public function __construct(CategoryRepoContract $categoryProvider){
        $this->categoryProvider = $categoryProvider; 
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $found = $this->categoryProvider->index(); 
        if ($found->count()){
            return ['message'=> 'categories found' , 'status'=>200 , 'categories'=>$found]; 
        }
        return ['message'=> 'there is no categories yet!' , 'status'=>204 , 'categories'=>$found]; }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response ()->json(['message'=>'create form' , 'status'=>200 , 'form'=>$this->categoryProvider->create()]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
       return response ()->json(['message'=>'stored' , 'record_id'=>$this->categoryProvider->store($request)->id , 'status'=>201] ); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $found = $this->categoryProvider->show($id); 
        if ($found){
            return response ()->json(['message'=>'category found' , 'status'=>200 , 'category'=>$found]); 
        }
        return response ()->json(['message'=>'category does not exist!' , 'status'=>204 , 'category'=>[]]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rowToEdit = $this->categoryProvider->edit($id); 
        if ($rowToEdit){
            return response()->json(['message'=>'category edit form' , 'status'=>200 , 'category'=>$rowToEdit]); 
        }
        return response ()->json (['message'=>'category does not exist!' , 'status'=>204 , 'category'=>[]]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($this->categoryProvider->update($request , $id) ){
            return response()->json(['message'=>'Category has been updated succsessfuly' , 'status'=>202 ]); 
        }; 
        return response()->json(['message'=>"category ID $id does not exist!" , 'status'=>204 ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->categoryProvider->destroy($id)){
            return response ()->json(['message'=>'deleted successfuly' , 'status'=>200]); 
        }
            return response ()->json(['message'=>"category id $id does not exist!" , 'status'=>204]); 
    }
}
