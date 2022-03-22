<?php

namespace App\Http\Controllers;

use App\Models\JadwalProduksi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalProduksiController extends Controller
{
    public function index()
    {
        $data = JadwalProduksi::all();
        return view('admin.jadwal_produksi.index', compact("data"));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = new JadwalProduksi();
        $data->nama_barang = $request->nama_barang;
        $data->tanggal = $request->tanggal;
        $data->jeniswarna_barang = $request->jenis;
        $data->jumlah_barang = $request->target;
        $data->save();
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
        return view("admin.jadwal_produksi.edit", compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = JadwalProduksi::findOrFail($id);
        $data->nama_barang = $request->nama_barang;
        $data->tanggal = $request->tanggal;
        $data->jeniswarna_barang = $request->jenis;
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