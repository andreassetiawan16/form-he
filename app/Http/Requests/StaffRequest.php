<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'nama' => 'required',
            'posisi' => 'required',
            // 'email' => 'required|email',
            'no_wa' => 'required',
            // 'alamat' => 'required',
            'jenis_kelamin' => 'required',
            // 'tinggi' => 'required|integer',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'usia' => 'required|integer',
        ];
    }
}
