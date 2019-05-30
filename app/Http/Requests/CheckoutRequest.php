<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'email'     => 'required|email|max:200',
            'name'      => 'required|min:3|max:200',
            'address'   => 'required|min:3|max:200',
            'city'      => 'required|min:3|max:200',
            'province'      => 'required|min:3|max:200',
            'postalcode'      => 'required|numeric|min:2',
            'phone'      => 'required|min:7|max:50',
            'name_on_card'      => 'required|min:3|max:200',
        ];
    }
}
