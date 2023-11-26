<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piutang extends Model
{
    use HasFactory;
    public function penjualan()
    {
        // return $this->belongsTo(Penjualan::class, 'no_penjualan', 'id');
        return $this->belongsTo(Penjualan::class);
    }
}
