<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateThuongHieuRequest extends FormRequest
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
            'gioithieu' => 'required',
            'fileImage' => 'required|mimes:png,jpg',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'ten.required' => 'Bạn chưa nhập tên thương hiệu. Vui lòng nhập !',
            'ten.unique' => 'Tên thương hiệu đã được sử dụng. Vui lòng chọn tên khác !',

            'fileImage.required' => 'Bạn phải tải ảnh thương hiệu',
            'fileImage.mimes' => 'File tải lên không phải file ảnh',
            
            'gioithieu.required' => 'Bạn phải nhập giới thiệu thương hiệu. Vui lòng nhập giới thiệu !'
        ];
    }
}
