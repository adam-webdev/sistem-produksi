<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBahanBaku extends Model
{
    use HasFactory;
    protected $table = "permintaan_bahan_bakus";
    public function bahan_baku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}