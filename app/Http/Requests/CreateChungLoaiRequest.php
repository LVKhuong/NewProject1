<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateChungLoaiRequest extends FormRequest
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
            'ten' => 'required|unique:chungloais,ten'
        ];
    }

    
    public function messages()
    {
        return [
            'ten.required' => 'Bạn phải nhập tên chủng loại. Vui lòng nhập !',
            'ten.unique' => 'Tên chủng loại đã được sử dụng. Vui lòng chọn tên khác !'
        ];
    }
}
