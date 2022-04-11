<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    public function penjualandetail()
    {
        return $this->hasMany(PenjualanDetail::class);
    }
    public function piutang()
    {
        return $this->hasMany(Piutang::class);
    }
    public static function NoPenjualan()
    {
        $tanggalNow = Carbon::now()->format('d m Y');

        $angka = Penjualan::max('no_penjualan');
        $angkaNol = '';
        $angka = substr($angka, 10);
        $angka = (int) $angka + 1;
        $incrementAngka = $angka;

        if (strlen($angka) == 1) {
            $angkaNol = "000";
        } elseif (strlen($angka) == 2) {
            $angkaNol = "00";
        } elseif (strlen($angka) == 3) {
            $angkaNol = "0";
        }

        $tanggalNow = Carbon::now()->format('d m Y');

        $angkaBaru = "NP" . str_replace(" ", "", $tanggalNow) . $angkaNol . $incrementAngka;
        return $angkaBaru;
    }
}