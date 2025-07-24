<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataSioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'nik' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'no_sio' => 'required|string|max:255|unique:data_sios,no_sio',
            'type' => 'required|string|max:255',
            'class' => 'required|string|max:255',
            'expire_date' => 'required|date',
            'status' => 'required|in:active,expired,pending',
            'location' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User harus dipilih.',
            'user_id.exists' => 'User tidak valid.',
            'jenis_sio.required' => 'Jenis SIO wajib diisi.',
            'nomor_sio.required' => 'Nomor SIO wajib diisi.',
            'nomor_sio.unique' => 'Nomor SIO sudah terdaftar.',
            'tanggal_terbit.required' => 'Tanggal terbit wajib diisi.',
            'tanggal_expired.required' => 'Tanggal expired wajib diisi.',
            'tanggal_expired.after' => 'Tanggal expired harus setelah tanggal terbit.',
            'file_sio.string' => 'Path file harus berupa string.',
        ];
    }
}