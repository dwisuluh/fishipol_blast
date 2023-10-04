<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class,'kode_prodi','kode');
    }
}
