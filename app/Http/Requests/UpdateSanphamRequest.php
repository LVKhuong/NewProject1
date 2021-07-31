<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSanphamRequest extends FormRequest
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
            'ten' => 'required|min:3',
            'gia' => 'required',
            'gioithieu' => 'required|min:10',
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Bạn không được bỏ trống',
            'ten.min' => 'Tên quá ngắn',

            'gia.required' => 'Phải nhập giá',
            
            'gioithieu.required' => "Giới thiệu không thể để trống",
            'gioithieu.min' => 'Giới thiệu quá ngắn',
        ];
    }

}
