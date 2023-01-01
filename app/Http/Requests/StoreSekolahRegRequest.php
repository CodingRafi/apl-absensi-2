<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSekolahRegRequest extends FormRequest
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
            'nama_sekolah' => 'required',
            'npsn' => 'required',
            'tingkat' => 'required',
            'ref_provinsi_id' => 'required',
            'ref_kabupaten_id' => 'required',
            'ref_kecamatan_id' => 'required',
            'ref_kelurahan_id' => 'required',
            'jalan' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'logo' => 'mimes:png,jpg,jpeg|file|max:5024'
        ];
    }
}
