<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupeStoreRequest extends FormRequest
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
            'nom' => ['required', 'string', 'max:100'],
            'nationalite' => ['required', 'string', 'max:100'],
            'date_creation' => ['required', 'date'],
            'date_destruction' => ['date'],
        ];
    }
}
