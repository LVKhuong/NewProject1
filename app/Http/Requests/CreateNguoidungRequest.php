<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateNguoidungRequest extends FormRequest
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
            'name' => 'required|min:5|max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
            'repassword' => 'required|same:password',
            'fileImage' => 'required|mimes:png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn phải nhập tên người dùng',
            'name.min' => 'Tên bạn phải có ít nhất 3 kí tự',
            'name.max' => 'Tên bạn chỉ có 10 kí tự trở xuống',

            'email.required' => 'Bạn phải nhập email',
            'email.email' => 'Email bạn nhập không hợp lệ',
            'email.unique' => 'Email bạn nhập đã có người sử dụng',

            'password.required' => 'Bạn phải nhập mật khẩu',
            'password.min' => 'Mật khẩu của bạn quá ngắn',

            'repassword.required' => 'Bạn phải nhập lại mật khẩu',
            'repassword.same' => 'Mật khẩu bạn nhập không giống nhau',

            'fileImage.required' => 'Bạn phải tải ảnh đại diện lên',
            'fileImage.mimes' => 'File tải lên không phải file ảnh',
        ];
    }

}
