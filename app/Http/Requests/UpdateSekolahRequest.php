<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSekolahRequest extends FormRequest
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
            'nama' => 'required',
            'npsn' => 'required',
            'kepala_sekolah' => 'required',
            'alamat' => 'required',
            'logo' => 'mimes:jpg,jpeg,png|file|max:5024'
        ];
    }
}
