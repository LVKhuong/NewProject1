<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'user' => 'required|unique:roles,id_user',
        ];
    }

    public function messages()
    {
        return [
            'user.required' => 'Bạn chưa chọn người dùng',
            'user.unique' => 'Người dùng đã được tạo rồi ! Vui lòng vào sửa !',
        ];
    }
}