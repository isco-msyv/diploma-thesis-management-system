<?php

namespace App\Http\Requests;

use App\Helpers\UserType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->type === UserType::TEACHER;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'project_id' => ['required', Rule::exists('projects', 'id')->where('teacher_id', auth()->user()->id)],
            'description' => ['required', 'string']
        ];
    }
}
