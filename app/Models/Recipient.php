<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public function kontak()
    {
        return $this->belongsTo(Kontak::class);
    }

    public function message()
    {
        return $this->belongsTo(SendWa::class);
    }
}
