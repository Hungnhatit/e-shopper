<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
  public function rules(): array
  {
    return [
      'title' => 'required',
      'image' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
      'description' => 'required',
      'content' => 'required'
    ];
  }

  public function messages()
  {
    return [
      'image.mimes' => ':attribute phải là định dạng jpg, jpeg, png, gif',
      'image.max' => ':attribute không được lớn hơn :max'
    ];

  }
}
