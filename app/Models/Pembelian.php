<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $table = 'pembelians';
    // protected $primaryKey = 'no_pembelian'; // or null
    public $incrementing = false;

    public function pembeliandetail()
    {
        return $this->hasMany(PembelianDetail::class);
    }
    public function hutang()
    {
        return $this->hasMany(Hutang::class);
    }
    public static function NoPembelian()
    {
        $tanggalNow = Carbon::now()->format('d m Y');

        $angka = Pembelian::max('no_pembelian');
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