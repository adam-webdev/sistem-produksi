<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalProduksi extends Model
{
    use HasFactory;
    protected $table = 'jadwal_produksis';

    public function pencatatanproduksi()
    {
        return $this->hasOne(PencatatanProduksi::class);
    }

    public function finishgood()
    {
        return $this->belongsTo(FinishGood::class);
    }

    public static function kode()
    {
        $tanggalNow = Carbon::now()->format('d m Y');

        $angka = JadwalProduksi::max('kode_jadwalproduksi');
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

        $angkaBaru = "PP" . str_replace(" ", "", $tanggalNow) . $angkaNol . $incrementAngka;
        return $angkaBaru;
    }
}