<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function finishgood()
    {
        return $this->belongsTo(FinishGood::class);
    }
}