<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
     * Valigate messages
     *
     * @return array
     */
    public function messages()
    {
        return [
            'content.required' => "内容 不能为空。",
            'content.min'      => "内容 不能少于5个字符。",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content'  => 'required|min:5'
        ];
    }
}
