<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateThuoctinhRequest extends FormRequest
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
            'id_sanpham' => 'required',
            'file_mausac' => 'required|unique:thuoctinhs,mausac',
        ];
    }

    public function messages()
    {
        return [
            'id_sanpham.required' => 'Bạn phải chọn sản phẩm',

            'file_mausac.unique' => "Sản phẩm đã được tạo rồi",
            'file_mausac.required' => 'Bạn phải tải ảnh màu săc',
        ];
    }
}
