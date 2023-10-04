<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaGroup extends Model
{
    use HasFactory, HasUuids;

    public function groupWa()
    {
        return $this->belongsTo(GroupWa::class);
    }

    public function kontakWa()
    {
        return $this->belongsToMany(Kontak::class);
    }
}
