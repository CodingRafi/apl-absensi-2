<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
    public function rules()
    {
        return [
            'name' => 'required',
            'nisn' => 'required',
            'nipd' => 'required',
            'nik' => 'required',
            'jk' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'kelas_id' => 'required',
            'kompetensi_id' => 'required',
            'agama' => 'required',
            'jalan' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
        ];
    }
}
