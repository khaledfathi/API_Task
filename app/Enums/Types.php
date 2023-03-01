<?php
namespace App\Enums; 

enum Types : string 
 {
    case super_admin = 'super_admin'; 
    case admin = 'admin'; 
    case user = 'user'; 
}