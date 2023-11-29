<?php

namespace App\Http\Controllers;

use App\Models\FinishGood;
use App\Models\JadwalProduksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Direktur|Produksi');
    }

    public function index()
    {
        $kodeGenerator = JadwalProduksi::kode();
        $data = JadwalProduksi::with('finishgood')->get();
        $finishgoods = FinishGood::all();
        return view('gudang.jadwal_produksi.index', compact("data", "finishgoods", "kodeGenerator"));
    }

    public function cekjadwalproduksi()
    {
        $data = JadwalProduksi::with('finishgood')->get();
        return view('produksi.cekjadwalproduksi', compact('data'));
    }

    public function create()
    {
        $kodeGenerator = JadwalProduksi::kode();
        $data = JadwalProduksi::with('finishgood')->get();
        $finishgoods = FinishGood::all();

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

        return view('gudang.jadwal_produksi.create', compact("data", "finishgoods", "kodeGenerator", "produk_terlaris"));
    }

    public function store(Request $request)
    {
        $jumlah = $request->input('target', []);
        $finishgood = $request->input('finishgood_id', []);
        $datas = [];
        foreach ($finishgood as $index => $value) {
            $datas[] = [
                "tanggal" => $request->tanggal,
                "finishgood_id" => $finishgood[$index],
                "kode_jadwalproduksi" => $request->kode,
                "jumlah_barang" => $jumlah[$index],
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ];
        }
        JadwalProduksi::insert($datas);
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('jadwal-produksi.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = JadwalProduksi::findOrFail($id);
        $finishgoods = FinishGood::all();
        return view("gudang.jadwal_produksi.edit", compact('data', 'finishgoods'));
    }


    public function update(Request $request, $id)
    {
        $data = JadwalProduksi::findOrFail($id);
        $data->tanggal = $request->tanggal;
        $data->kode_jadwalproduksi =  $data->kode_jadwalproduksi;
        $data->finishgood_id = $request->finishgood_id;
        $data->jumlah_barang = $request->target;
        $data->save();
        Alert::success('Tersimpan', 'Data Berhasil Disimpan');
        return redirect()->route('jadwal-produksi.index');
    }


    public function delete($id)
    {
        $barang = JadwalProduksi::findOrFail($id);
        $barang->delete();
        Alert::success('Terhapus', 'Data Berhasil Dihapus');
        return redirect()->route('jadwal-produksi.index');
    }
}
