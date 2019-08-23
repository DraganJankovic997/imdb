<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createMovie extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
            'genre_id' => 'required|exists:genres,id',
            'image_url' => 'required|string',
        ];
    }
}
