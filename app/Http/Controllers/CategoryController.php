<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryStoreRequest;
use App\Repository\Contracts\CategoryRepoContract;
use App\Rules\UniqueOnChange;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryProvider ; 
    public function __construct(CategoryRepoContract $categoryProvider){
        $this->categoryProvider = $categoryProvider; 
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $categories = $this->categoryProvider->index(); 
        return view('category.index' , ['categories' => $categories]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create' ); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $this->categoryProvider->store($request);
        return redirect('category'); 
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
        $record =  $this->categoryProvider->edit($request->id); 
        return view('category/edit' , ['record'=>$record]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $update = $this->categoryProvider->update($request , $request->id );
        if ($update) {
            return redirect('category'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $this->categoryProvider->destroy($request->id);
        return redirect ('category');  
    }
}
