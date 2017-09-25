<?php

namespace App\Http\Requests\Picture;

use Illuminate\Foundation\Http\FormRequest;
use App\Picture;

class PictureRequest extends FormRequest
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
            'image' => 'required|mimes:jpeg,bmp,png|image|max:4096',
        ];
    }

    public function messages()
    {
        return [
            'image.required'          => 'ファイルが読み込まれていません。',
            'image.mimes'             => '画像ファイル以外のファイルが読み込まれています。',
            'image.image'             => '画像ファイル以外のファイルが読み込まれています。',
            'image.max'               => '読み込める画像の最大サイズは4MBです。',
        ];
    }
}
