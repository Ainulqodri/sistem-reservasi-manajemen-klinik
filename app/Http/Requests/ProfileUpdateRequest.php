<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama'           => ['required', 'string', 'max:255'],
            'tanggal_lahir'  => ['nullable', 'date'],
            'jenis_kelamin'  => ['nullable', 'in:Laki-laki,Perempuan'],
            'alamat'         => ['nullable', 'string', 'max:255'],
            'pekerjaan'      => ['nullable', 'string', 'max:255'],
            'nomor_telepon'  => ['nullable', 'string', 'max:20'],
            'email'          => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user()->id)],
        ];
    }
}
