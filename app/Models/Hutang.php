<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hutang extends Model
{
    use HasFactory;
    public function pembelian()
    {
        // return $this->belongsTo(Pembelian::class, 'no_pembelian', 'id');
        return $this->belongsTo(Pembelian::class);
    }
}
