<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChucNangRequest extends FormRequest
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
            'email' => 'required|unique:chuc_nang_users,tenemail'
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Bạn cần chọn email',
            'email.unique' => 'Người dùng đã được tạo ',
        ];
    }

}
