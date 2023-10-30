<?php

namespace App\Http\Requests\Post;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class StorePostVoteRequest extends FormRequest
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
            'votable_type' => 'required|string|in:App\Models\Post,App\Models\PostComment',
            'user_id' => 'nullable|integer|exists:users,id',
            'uid' => 'nullable|integer'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $votableType = $this->input('votable_type');
        if($votableType === 'App\Models\Post') {
            $validator->addRules(['votable_id' => 'required|integer|exists:posts,id']);
        } else {
            $validator->addRules(['votable_id' => 'required|integer|exists:post_comments,id']);
        }
    }
}

