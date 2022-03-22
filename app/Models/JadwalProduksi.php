<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalProduksi extends Model
{
    use HasFactory;
    protected $table = 'jadwal_produksis';
    public function pencatatanproduksi()
    {
        return $this->hasOne(PencatatanProduksi::class);
    }
}