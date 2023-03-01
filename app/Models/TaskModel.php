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
    ]; 

}
