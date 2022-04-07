<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishGood extends Model
{
    use HasFactory;
    protected $table = 'finish_goods';

    public function stokfinishgood()
    {
        return $this->hasOne(StokFinishGood::class);
    }
    public function pencatatanproduksi()
    {
        return $this->hasOne(PencatatanProduksi::class);
    }

    public function jadwalproduksi()
    {
        return $this->hasMany(JadwalProduksi::class);
    }
}