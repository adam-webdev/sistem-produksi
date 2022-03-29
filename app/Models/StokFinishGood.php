<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokFinishGood extends Model
{
    use HasFactory;
    protected $table = 'stok_finish_goods';

    public function finishgood()
    {
        return $this->belongsTo(FinishGood::class);
    }

    public function pencatatanproduksi()
    {
        return $this->hasOne(PencatatanProduksi::class);
    }

    public function jadwalproduksi()
    {
        return $this->hasOne(JadwalProduksi::class);
    }
}