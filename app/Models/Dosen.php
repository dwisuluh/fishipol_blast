<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function kontak()
    {
        return $this->hasOne(Kontak::class);
    }

    public static function boot()
    {
        parent::boot();

        self::updated(function($dosen) {
            $dosen->syncKontak();
        });
    }

    public function syncKontak()
    {
        $kontak = Kontak::where('dosen_id', $this->id)
            // ->where('kontakable_type', Tendik::class)
            ->first();

        if ($kontak) {
            $kontak->nama = $this->name;
            $kontak->no_hp = $this->no_hp;
            $kontak->save();
        }
    }
}
