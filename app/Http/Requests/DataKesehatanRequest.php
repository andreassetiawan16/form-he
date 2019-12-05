<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataKesehatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'peserta_id' => 'required',
            'tanggal_he' => 'required',
            'dokter_id' => 'required',
            'petugas_id' => 'required'
        ];
    }
}
