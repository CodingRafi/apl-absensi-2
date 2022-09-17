<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSiswaRequest extends FormRequest
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
            'name' => 'required',
            'nisn' => 'required|unique:siswas',
            'nipd' => 'required|unique:siswas',
            'email' => [Rule::unique('siswas'), Rule::unique('users')],
            'nik' => 'required|unique:siswas',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas_id' => 'required',
            'agama' => 'required',
            'jalan' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'profil' => 'mimes:png,jpg,jpeg|max:5024',
            'rfid_number' => 'unique:rfids'
        ];
    }
}
