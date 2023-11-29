<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Piutang;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $penjualan_total = Penjualan::select('total')->sum('total');
        $pembelian_total = Pembelian::select('total')->sum('total');
        $hutang = Hutang::select('total')->sum('total');
        $piutang = Piutang::select('total')->sum('total');



        $produk_terlaris = DB::table('penjualan_details')
            ->join('finish_goods', 'penjualan_details.finishgood_id', '=', 'finish_goods.id')
            ->select(
                'finish_goods.nama_fg',
                DB::raw('YEAR(penjualan_details.tanggal_penjualan) as tahun'),
                DB::raw('MONTH(penjualan_details.tanggal_penjualan) as bulan'),
                DB::raw('SUM(penjualan_details.jumlah) as jumlah_penjualan')
            )
            // ->whereYear('penjualan_details.tanggal_penjualan', Carbon::now()->year)
            // ->whereMonth('penjualan_details.tanggal_penjualan', Carbon::now()->month)
            ->groupBy('finish_goods.id', 'finish_goods.nama_fg', 'tahun', 'bulan')
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->orderBy('jumlah_penjualan', 'desc')
            ->take(5)
            ->get();

        // ddd($produk_terlaris);
        return view('dashboard', compact('penjualan_total', 'pembelian_total', 'hutang', 'piutang', 'produk_terlaris'));
    }
    public function getByBulanTahun(Request $request)
    {
        if ($request->ajax()) {
            $produk_terlaris = DB::table('penjualan_details')
                ->join('finish_goods', 'penjualan_details.finishgood_id', '=', 'finish_goods.id')
                ->select(
                    'finish_goods.nama_fg',
                    DB::raw('YEAR(penjualan_details.tanggal_penjualan) as tahun'),
                    DB::raw('MONTH(penjualan_details.tanggal_penjualan) as bulan'),
                    DB::raw('SUM(penjualan_details.jumlah) as jumlah_penjualan')
                )
                ->whereYear('penjualan_details.tanggal_penjualan', $request->tahun)
                ->whereMonth('penjualan_details.tanggal_penjualan', $request->bulan)
                ->groupBy('finish_goods.id', 'finish_goods.nama_fg', 'tahun', 'bulan')
                ->orderBy('tahun', 'desc')
                ->orderBy('bulan', 'desc')
                ->orderBy('jumlah_penjualan', 'desc')
                ->take(5)
                ->get();

            return response()->json($produk_terlaris);
        }
    }
}
