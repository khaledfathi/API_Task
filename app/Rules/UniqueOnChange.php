<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class UniqueOnChange implements ValidationRule
{
    private $table; 
    private $id; 
    public function __construct(string $table , int $id){
        $this->table= $table  ; 
        $this->id = $id; 
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $Selected = (array)DB::table($this->table)->select($attribute)->where('id', $this->id)->first() ;
        if ($Selected[$attribute] != $value){
            $isDuplicated = (array)DB::table($this->table)->select($attribute)->where($attribute, $value)->first() ;
            if ($isDuplicated) $fail($attribute . $value . ' is already exist!'); 
        }
    }
}
