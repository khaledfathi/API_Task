<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    use HasFactory;
    public $table = 'tasks'; 
    protected  $fillable=[
        'title', 
        'desctiption', 
        'start_date', 
        'end_date', 
        'assign_at',
        'status',
        'priority', 
        'category_id',
        'assignee_id', 
        'creator_id'
    ]; 
    protected $hidden =[
        'created_at', 
        'updated_at'
    ] ;

}
