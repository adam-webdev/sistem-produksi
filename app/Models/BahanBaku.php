<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;
    protected $table = 'bahan_bakus';
    public function bahanbaku_keluar()
    {
        return $this->hasOne(BahanBakuKeluar::class);
    }
    public function bahanbaku_masuk()
    {
        return $this->hasOne(BahanBakuMasuk::class);
    }
}