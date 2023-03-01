<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ForeignKey implements ValidationRule
{
    private $table ; 
    public function __construct(string $table){
        $this->table= $table; 
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if( ! DB::table($this->table)->where('id' , $value)->first()){
            $fail("$attribute is a ForeignKey and it does not exist in $this->table table");
        }
    }
}
