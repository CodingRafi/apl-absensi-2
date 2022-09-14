<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class UpdateSiswaRequest extends FormRequest
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
    public function rules(Request $request)
    {
        dd($request);
        return [
            'name' => 'required',
            'nisn' => 'required',
            'nipd' => ['required', Rule::unique('siswas')->ignore($user->id)],
            'nik' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas_id' => 'required',
            'agama' => 'required',
            'jalan' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'profil' => 'mimes:png,jpg,jpeg|max:5024'
        ];
    }
}
