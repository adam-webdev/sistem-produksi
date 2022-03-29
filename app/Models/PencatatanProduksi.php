<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencatatanProduksi extends Model
{
    use HasFactory;
    protected $table = "pencatatan_produksis";

    public function jadwalproduksi()
    {
        return $this->belongsTo(JadwalProduksi::class, 'jadwal_produksi_id', 'id');
    }

    public function stokfinishgood()
    {
        return $this->belongsTo(StokFinishGood::class);
    }
}