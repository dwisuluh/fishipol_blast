<?php

namespace App\Imports;

use App\Models\Tendik;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TendikImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tendik([
            'nip'   => $row['nip'],
            'name' => $row['nama'],
            'no_hp' => $row['no_hp'],
            'email' => $row['email']
        ]);
    }
}
