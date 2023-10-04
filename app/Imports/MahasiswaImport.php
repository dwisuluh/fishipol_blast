<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function rules(): array
    {
        return [
            'nim' => 'required|unique:mahasiswas,nim',
            'nama' => 'required',
            'no_hp' => 'required',
            'email' => 'required|unique:mahasiswas,email',
            'kode_prodi' => [
                'required',
                Rule::exists('prodis', 'kode')->where(function ($query) {
                    $query->whereNotNull('id');
                })
            ]
        ];
    }

    public function model(array $row)
    {
        return new Mahasiswa([
            "nim" => $row['nim'],
            "nama" => $row['nama'],
            "kode_prodi" => $row['kode'],
            "angkatan" => $row['angkatan'],
            "no_hp" => $row['no_hp'],
            "email" => $row['email'],
        ]);
    }
}
