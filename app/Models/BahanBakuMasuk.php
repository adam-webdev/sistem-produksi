<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBakuMasuk extends Model
{
    use HasFactory;
    protected $table = 'bahan_baku_masuks';

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
    public function stok()
    {
        return $this->belongsTo(Stok::class);
    }
}