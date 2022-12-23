<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => 'required',
            'jk' => 'required', 
            'tempat_lahir' => 'required', 
            'tanggal_lahir' => 'required', 
            'ref_agama_id' => 'required', 
            'ref_agama_id' => 'required', 
            'ref_provinsi_id' => 'required', 
            'ref_kabupaten_id' => 'required', 
            'ref_kecamatan_id' => 'required', 
            'ref_kelurahan_id' => 'required', 
            'jalan' => 'required',  
            'profil' => 'mimes:png,jpg,jpeg|file|max:5024',
            'email' => ['required', Rule::unique('users')->ignore($this->id)]
        ];
    }
}
