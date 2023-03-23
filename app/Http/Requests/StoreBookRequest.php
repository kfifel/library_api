<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>        'required|max:255',
            'author'=>       'required|string|max:255',
            'isbn'=>         'required',
            'number_pages'=> 'required|numeric|min:1',
            'location'=>     'required',
            'status'=>       'required|in:new,good,medium,damaged',
            'content'=>      'required|min:10',
            'collection_id' =>  'numeric|exists:collections,id',
            'genre_id' =>  'required|numeric|exists:genres,id',
        ];
    }
}
