<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupeUpdateRequest extends FormRequest
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
            'nom' => ['string', 'max:100'],
            'nationalite' => ['string', 'max:100'],
            'date_creation' => ['date'],
            'date_destruction' => ['date'],
        ];
    }
}
