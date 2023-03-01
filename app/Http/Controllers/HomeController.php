<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function HomePage(){
        $tables=[ 
            'users'=>User::orderBy('id' , 'desc')->get(),
            'tasks'=>TaskModel::orderBy('id' , 'desc')->get(),
            'categories'=>CategoryModel::orderBy('id' ,'desc')->get(),
            'tokens'=>DB::table('personal_access_tokens')->orderBy('id', 'desc')->get()
        ]; 
        return view('home' , ['tables'=>$tables]); 
    }
    public function DiagramsPage(){
        return view('diagrams');  
    }
}
