<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'title' => 'required|min:2|max:75',
          'location' => 'required|min:2',
          'url' => 'max:255',
          'posted_by' => 'max:75',
          'seniority_level' => 'max:155',
          'compensation' => 'max:255',
        ];
    }
}
