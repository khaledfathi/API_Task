<?php
namespace App\Repository; 

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Repository\Contracts\CategoryRepoContract;
use App\Models\CategoryModel;
use App\Rules\UniqueOnChange;
use Illuminate\Http\Request; 

class CategoryRepo implements CategoryRepoContract
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return CategoryModel::all(); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return ['title']; 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        return CategoryModel::create([
            'title'=>$request->title, 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return CategoryModel::where('id' , $id)->first(); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return CategoryModel::select('id', 'title')->where('id' , $id)->first(); 
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $found = CategoryModel::find($id); 
        if ($found){
            $request->validate([
                'title'=>['required', new UniqueOnChange('categories',$id)],
            ]);
            $found->update([
                'title'=>$request->title, 
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
        $found = CategoryModel::find($id); 
        if($found){
            $found->delete(); 
            return true; 
        }
        return false ; 
    }
}
