<?php

namespace App\Models;

use Illuminate\Support\Str;
// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontak extends Model
{
    use HasFactory, HasUuids;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = ['id'];
    protected $fillable = ['nama'];
    // protected $primaryKey = 'id';

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function tendik()
    {
        return $this->belongsTo(Tendik::class);
    }

    public function recipient()
    {
        return $this->hasMany(Recipient::class);
    }

    public function anggota_group()
    {
        return $this->hasMany(AnggotaGroup::class);
    }

    // public static function boot()
    // {
    //     parent::boot();

    //     self::creating(function ($model) {
    //         $model->uuid = (string) Str::uuid();
    //     });
    // }
}
