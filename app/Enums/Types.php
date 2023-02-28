<?php
namespace App\Enums; 

enum Status : string 
 {
    case super_admin = 'super_admin'; 
    case admin = 'admin'; 
    case user = 'user'; 
}