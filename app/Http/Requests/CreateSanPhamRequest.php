<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateSanPhamRequest extends FormRequest
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
            'ten' => 'required|min:3|unique:sanphams,ten',
            'gia' => 'required',
            'fileImage' => 'required',
            'gioithieu' => 'required|min:10',
        ];
    }
    

    public function messages(){
        return [
            'ten.required' => 'Bạn chưa nhập tên người dùng. Vui lòng nhập',
            'ten.min' => 'Tên sản phẩm có ít nhất 3 kí tự. Vui lòng nhập thêm',
            'ten.unique' => 'Tên sản phẩm đã sử dụng. Vui lòng chọn tên khác',

            'gia.required' => 'Bạn chưa nhập giá. Vui lòng nhập',
            
            'fileImage.required' => 'Bạn chưa tải file ảnh lên',

            'gioithieu.required' => 'Bạn chưa nhập giới thiệu',
            'gioithieu.min' => 'Giới thiệu phải ít nhất 10 kí tự',
        ];
    }
}
