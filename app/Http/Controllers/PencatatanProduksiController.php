<?php

namespace App\Http\Controllers;

use App\Models\JadwalProduksi;
use App\Models\PencatatanProduksi;
use App\Models\StokFinishGood;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PencatatanProduksiController extends Controller
{
    public function index()
    {
        $jadwalproduksi = JadwalProduksi::all();
        $stokfinishgood = StokFinishGood::all();
        $data = PencatatanProduksi::with('jadwalproduksi', 'stokfinishgood')->get();
        return view('produksi.pencatatan_produksi.index', compact("data", "jadwalproduksi", "stokfinishgood"));
    }

    public function create()
    {
    }


    public function store(Request $request)
    {

        $id = PencatatanProduksi::where('jadwal_produksi_id', $request->jadwalproduksi_id)->first();
        if ($id) {
            Alert::error("Gagal", "Kode Jadwal Produksi sudah ada");
            return redirect()->route('pencatatan-produksi.index');
        }

        $data = new PencatatanProduksi();
        $data->jadwal_produksi_id = $request->jadwalproduksi_id;
        $data->stokfinishgood_id = $request->stokfinishgood_id;
        $data->jumlah = $request->jumlah;
        $data->keterangan = $request->keterangan;
        $data->save();
        Alert::success("Tersimpan", "Data Berhasil Disimpan");
        return redirect()->route('pencatatan-produksi.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = PencatatanProduksi::findOrFail($id);
        $jadwalproduksi = JadwalProduksi::all();
        $stokfinishgood = StokFinishGood::all();

        return view("produksi.pencatatan_produksi.edit", compact("data", "jadwalproduksi", "stokfinishgood"));
    }

    public function update(Request $request, $id)
    {
        $data = PencatatanProduksi::findOrFail($id);
        $data->jadwal_produksi_id = $request->jadwalproduksi_id;
        $data->stokfinishgood_id = $request->stokfinishgood_id;
        $data->jumlah = $request->jumlah;
        $data->keterangan = $request->keterangan;
        $data->save();
        Alert::success("Terupdate", "Data Berhasil Diupdate");
        return redirect()->route('pencatatan-produksi.index');
    }

    public function delete($id)
    {
        $data = PencatatanProduksi::findOrFail($id);
        $data->delete();
        Alert::success("Terhapus", "Data Berhasil Dihapus");
        return redirect()->route('pencatatan-produksi.index');
    }
}