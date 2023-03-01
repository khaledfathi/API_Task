<?php
namespace App\Enums; 

enum TaskStatus: string {
    case new = 'new'; 
    case in_progress = 'in_progress'; 
    case completed = 'completed'; 
    case rejected = 'rejected'; 
    case success = 'success'; 
}