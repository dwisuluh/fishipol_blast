<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupWa extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function anggotaGroup()
    {
        return $this->hasMany(AnggotaGroup::class);
    }
}
