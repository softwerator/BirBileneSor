<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswer extends FormRequest
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
            'token'       => 'required|string|exists:users,login_token',
            'question_id' => 'required|numeric|exists:questions,id',
            'answer'      => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'title'       => 'Başlık',
            'question_id' => 'Soru ID',
            'answer'      => 'Cevap',
        ];
    }


}
