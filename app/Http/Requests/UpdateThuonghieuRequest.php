<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThuonghieuRequest extends FormRequest
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
            'ten' => 'required|unique:thuonghieus,ten',
        ];
    }

    public function messages()
    {
        return [
            'ten.required' => 'Tên thương hiệu không thể để trống',
            'ten.unique' => 'Tên thương hiệu đã có',
        ];
    }

}
