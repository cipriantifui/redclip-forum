<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostImageRequest extends FormRequest
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
            'topic_id' => 'required|integer|exists:topics,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'uid' => 'nullable|integer',
            'title' => 'required|string|min:3|max:200',
            'file_image' => 'required|mimes:jpeg,jpg,png,gif|max:20000'
        ];
    }
}
