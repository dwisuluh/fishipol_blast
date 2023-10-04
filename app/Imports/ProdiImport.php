<?php

namespace App\Imports;

use App\Models\ProgramStudi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdiImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ProgramStudi([
            "nama" => $row['nama'],
            "kode" => $row['kode'],
            "departemen" => $row['departemen'],
            "jenjang" => $row['jenjang'],
        ]);
    }
}
