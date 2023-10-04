<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function prodi()
    {
        return $this->hasOne(ProgramStudi::class,'kode','kode_prodi');
    }

    public function kontak()
    {
        return $this->hasOne(Kontak::class);
    }

    public static function boot()
    {
        parent::boot();

        self::updated(function($mahasiswa) {
            $mahasiswa->syncKontak();
        });
    }

    public function syncKontak()
    {
        $kontak = Kontak::where('mahasiswa_id', $this->id)
            // ->where('kontakable_type', Tendik::class)
            ->first();

        if ($kontak) {
            $kontak->nama = $this->nama;
            $kontak->no_hp = $this->no_hp;
            $kontak->save();
        }
    }
}
