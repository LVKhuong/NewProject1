<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChungloaiRequest extends FormRequest
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
            'ten' => 'required|unique:chungloais,ten',
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Tên chủng loại không thể trống',
            'ten.unique' => 'Tên chủng loại đã có',
        ];
    }

}
