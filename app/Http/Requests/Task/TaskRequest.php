<?php

namespace App\Http\Requests\Task;

use App\Enums\Priority;
use App\Enums\TaskStatus;
use App\Rules\ForeignKey;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum; 

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'=>'required', 
            'description'=>'', 
            'start_date'=>'required|date', 
            'end_date'=>'required|date', 
            'assign_at'=>'required|date',
            'status'=>['required' , new Enum(TaskStatus::class)],
            'priority'=>['required', new Enum(Priority::class)],
            'category_id'=>[Rule::requiredIf(fn()=>$this->getMethod()!="PUT") , new ForeignKey('categories')],
            'creator_id'=>[Rule::requiredIf(fn()=>$this->getMethod()!="PUT") , new ForeignKey('users')],
            'assignee_id'=>[Rule::requiredIf(fn()=>$this->getMethod()!="PUT") , new ForeignKey('users')],
        ]; 

    }
}
