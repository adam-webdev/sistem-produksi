<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;
    protected $table = 'pembelian_details';
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
    public function bahanbaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
    public function hutang()
    {
        return $this->hasOne(Hutang::class);
    }
}