<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;

    protected $table = 'bahan_bakus';

    public function bahanbakukeluar()
    {
        return $this->hasOne(BahanBakuKeluar::class);
    }

    public function bahanbakumasuk()
    {
        return $this->hasOne(BahanBakuMasuk::class);
    }

    public function stok()
    {
        return $this->hasOne(Stok::class);
    }

    public function permintaanbahanbaku()
    {
        return $this->hasOne(Stok::class);
    }
}