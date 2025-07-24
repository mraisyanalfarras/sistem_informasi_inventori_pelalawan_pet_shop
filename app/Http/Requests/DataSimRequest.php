<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataSimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'nik' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'no_sim' => 'required|string|max:255|unique:data_sims,no_sim',
            'position' => 'required|string|max:255',
            'type_sim' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'expire_date' => 'required|date',
            'reminder' => 'nullable|date',
            'status' => 'required|in:active,expired,revoked',
            'foto' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User harus dipilih.',
            'user_id.exists' => 'User tidak valid.',
            'nik.required' => 'NIK wajib diisi.',
            'name.required' => 'Nama wajib diisi.',
            'no_sim.required' => 'Nomor SIM wajib diisi.',
            'no_sim.unique' => 'Nomor SIM sudah terdaftar.',
            'position.required' => 'Posisi wajib diisi.',
            'type_sim.required' => 'Jenis SIM wajib diisi.',
            'location.required' => 'Lokasi wajib diisi.',
            'expire_date.required' => 'Tanggal kedaluwarsa wajib diisi.',
            'expire_date.date' => 'Format tanggal kedaluwarsa tidak valid.',
            'reminder.date' => 'Format tanggal pengingat tidak valid.',
            'status.required' => 'Status wajib diisi.',
            'status.in' => 'Status harus berupa Active, Expired, atau Revoked.',
            'foto.string' => 'Foto harus berupa path file yang valid.',
        ];
    }
}
