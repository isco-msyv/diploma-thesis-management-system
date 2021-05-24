<?php

namespace App\Http\Requests;

use App\Helpers\UserType;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopicStore extends FormRequest
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
        $students = User::where('type', '=', UserType::STUDENT)->doesntHave('studentProject')->get()->pluck('id')->toArray();

        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'student_id' => ['nullable', Rule::in($students)]
        ];
    }
}
