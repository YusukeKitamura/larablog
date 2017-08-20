<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Comment;

class CommentRequest extends FormRequest
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
        if (in_array($this->method(), ['PATCH', 'POST'])) {
            $rules = [
                'name'  => 'required',
                'body'  => 'required',
                'password'  => 'required|max:16'
            ];
        } elseif ($this->method() == 'DELETE' && !Auth::guard()->check()) {
            $rules = [
                'del_password'  => 'required'
            ];
        } else {
            return [];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required'           => '名前は必須です。',
            'body.required'           => '本文は必須です。',
            'password.required'       => 'パスワードは必須です。',
            'password.max'            => 'パスワードは最大16文字です。',
            'del_password.required'   => 'パスワードは必須です。',
        ];
    }
}
