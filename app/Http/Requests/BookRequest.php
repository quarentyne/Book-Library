<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|between:1,255',
            'description' => 'required|string|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=300,min_height=400',
            'release_date' => 'required|integer|digits:4|min:1000|max:' . date('Y'),
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ];
    }
}
