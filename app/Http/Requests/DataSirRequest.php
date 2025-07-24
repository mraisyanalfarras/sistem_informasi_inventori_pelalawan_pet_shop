<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataSirRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'nik' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'no_sir' => 'required|string|unique:data_sirs,no_sir,' . $this->route('datasir'),
            'expire_date' => 'required|date',
            'status' => 'required|in:active,expired,revoked',
            'reminder' => 'nullable|date',
            'location' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255'
        ];
    }
}
