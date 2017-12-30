<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
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
            'token'     => 'required|string|exists:users,login_token',
            'answer_id' => 'required|numeric|exists:answers,id',
            'comment'   => 'required|string',
        ];
    }

    public function attributes()
    {
        return [
            'answer_id' => 'Cevap ID',
            'comment'   => 'Yorum',
        ];
    }


}
