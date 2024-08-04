<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|min:8|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|same:password-c',
            'phone' => 'required',
            'address' =>'required',
            'country_id' => 'required',
            'avatar' => 'image|mimes:jpeg, png, jpg, gif|max:2048'
        ];
    }

    // Hàm dùng để thay đổi nội dung message
    public function messages()
    {
        return [
            'required'=>':attribute không được để trống',
            'max'=>':attribute không được quá :max ký tự',
            'image' => ':attribute phải là hình ảnh',
            'mimes' => ':attribute phai là định dạng như sau:jpeg, png, jpg, gif'            
        ];
    }
}
