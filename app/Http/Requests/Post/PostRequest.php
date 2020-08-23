<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use App\Post;

class PostRequest extends FormRequest
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
        $rules = [
            'title'         => 'required|max:40',
            'category_id'  => 'required',
            'body'          => 'required'
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required'          => 'タイトルは必須です。',
            'title.max'               => 'タイトルは最大40文字です。',
            'category_id.required'   => 'カテゴリーは必須です。',
            'body.required'           => '本文は必須です。',
        ];
    }
}
