<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Models\CategoryModel;
use App\Rules\UniqueOnChange;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $found = CategoryModel::all(); 
        if ($found->count()){
            return response ()->json(['message'=> 'categories found' , 'status'=>200 , 'categories'=>$found]); 
        }
        return response ()->json(['message'=> 'there is no categories yet!' , 'status'=>200 , 'categories'=>$found]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response ()->json(['message'=> 'create form' , 'status'=>200 , 'form'=>['title']]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $record = CategoryModel::create([
            'title'=>$request->title, 
        ]);
        return response ()->json (['message'=>'stored' , 'record_id'=>$record->id , 'status'=>200]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $found = CategoryModel::where('id' , $id)->first(); 
        if ($found){
            return response ()->json (['message'=>'category found' , 'status'=>200 , 'category'=>$found]); 
        }
        return response ()->json (['message'=>'category does not exist!' , 'status'=>200 , 'category'=>[]]); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rowToEdit = CategoryModel::select('title')->where('id' , $id)->first(); 
        if ($rowToEdit){
            return response ()->json (['message'=>'category edit form' , 'status'=>200 , 'category'=>$rowToEdit]); 
        }
        return response ()->json (['message'=>'category does not exist!' , 'status'=>200 , 'category'=>[]]); 
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $found = CategoryModel::find($id); 
        if ($found){
            $request->validate([
                'title'=>['required' , new UniqueOnChange('categories' , $id)],
            ]); 
            return response ()->json (['message'=>'Category has been updated succsessfuly' , 'status'=>200 , 'update'=>true]); 
        }
        return response ()->json (['message'=>'Category does not exist!' , 'status'=>200 , 'update'=>false]); 
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $found = CategoryModel::find($id); 
        if($found){
            $found->delete(); 
            return response ()->json (['message'=>'Category has been deleted succsessfuly' , 'status'=>200 , 'delete'=>true]); 
        }
        return response ()->json (['message'=>'category does not exist!' , 'status'=>200 , 'delete'=>false]); 
    }
}
