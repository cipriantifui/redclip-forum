<?php

namespace App\Http\Requests\topic;

use Illuminate\Foundation\Http\FormRequest;

class IndexPaginatedRequest extends FormRequest
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
            'perPage' => 'required|integer',
            'page' => 'required|integer',
            'orderByColumns' => 'nullable|array',
        ];
    }
}
