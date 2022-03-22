<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $table = 'stoks';

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
    public function bahanbakukeluar()
    {
        return $this->hasOne(BahanBakuKeluar::class);
    }

    public function bahanbakumasuk()
    {
        return $this->hasOne(BahanBakuMasuk::class);
    }
}