<?php

namespace App\Http\Controllers;

use App\Models\FinishGood;
use App\Models\JadwalProduksi;
use App\Models\StokFinishGood;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        $data = JadwalProduksi::with('stokfinishgood')->get();
        $stokfinishgoods = StokFinishGood::all();
        return view('gudang.jadwal_produksi.index', compact("data", "stokfinishgoods", "kodeGenerator"));
    }

    public function cekjadwalproduksi()
    {
        $data = JadwalProduksi::with('stokfinishgood')->get();
        return view('produksi.cekjadwalproduksi', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $jumlah = $request->input('target', []);
        $stokfinish = $request->input('stokfinishgood_id', []);
        $datas = [];
        foreach ($stokfinish as $index => $value) {
            $datas[] = [
                "tanggal" => $request->tanggal,
                "stokfinishgood_id" => $stokfinish[$index],
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
        $stokfinishgoods = StokFinishGood::all();
        return view("gudang.jadwal_produksi.edit", compact('data', 'stokfinishgoods'));
    }


    public function update(Request $request, $id)
    {
        $data = JadwalProduksi::findOrFail($id);
        $data->tanggal = $request->tanggal;
        $data->kode_jadwalproduksi =  $data->kode_jadwalproduksi;
        $data->stokfinishgood_id = $request->stokfinishgood_id;
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