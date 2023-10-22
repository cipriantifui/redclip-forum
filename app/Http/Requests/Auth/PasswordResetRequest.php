<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class PasswordResetRequest extends FormRequest
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
    public function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|different:oldPassword',
            'confirmPassword' => 'required|same:newPassword',
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
        $email = $this->input('email');
        $oldPassword = $this->input('oldPassword');
        $user = User::where('email', $email)->first();
        if($user) {
            $validator->after(function ($validator) use($oldPassword, $user){
                if(Hash::check($oldPassword, $user->password) === false) {
                    $validator->errors()->add('oldPassword', 'The inserted password is invalid');
                }
            });
        }
    }
}
