<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtisteUpdateRequest extends FormRequest
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
            'prenom' => ['string', 'max:100'],
            'date_naissance' => ['string', 'max:100'],
            'date_deces' => ['string', 'max:100'],
            'nationalite' => ['string', 'max:100'],
            'pseudo' => ['string', 'max:100'],
        ];
    }
}
