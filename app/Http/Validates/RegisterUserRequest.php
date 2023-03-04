<?php

namespace App\Http\Validates;


class RegisterUserRequest extends ValidRequest
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
            'name' => 'required|min:6',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '姓名必填',
            'name.min' => '姓名长度最少6个字符',
            'email.required' => 'email必填',
            'email.email' => 'email格式不合法',
            'email.unique' => 'email已存在',
            'password.required' => '密码必填',
        ];
    }

}
