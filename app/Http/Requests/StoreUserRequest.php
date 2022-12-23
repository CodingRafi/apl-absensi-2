<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'jk' => 'required', 
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required', 
            'ref_agama_id' => 'required', 
            'ref_provinsi_id' => 'required', 
            'ref_kabupaten_id' => 'required', 
            'ref_kecamatan_id' => 'required', 
            'ref_kelurahan_id' => 'required', 
            'jalan' => 'required', 
            'rfid_number' => 'unique:rfids',
            'profil' => 'mimes:png,jpg,jpeg|file|max:5024'
        ];
    }
}
