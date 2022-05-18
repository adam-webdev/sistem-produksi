<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBakuKeluar extends Model
{
    use HasFactory;
    protected $table = 'bahan_baku_keluars';

    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
    public function stok()
    {
        return $this->belongsTo(Stok::class);
    }
}