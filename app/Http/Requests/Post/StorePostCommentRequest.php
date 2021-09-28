<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCommentRequest extends FormRequest
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
            'post_id' => 'required|integer|exists:posts,id',
            'user_id' => 'nullable|integer|exists:users,id',
            'parent_id' => 'nullable|integer|exists:post_comments,id',
            'uid' => 'nullable|integer',
            'content' => 'required|string|min:3|max:2500'
        ];
    }
}

