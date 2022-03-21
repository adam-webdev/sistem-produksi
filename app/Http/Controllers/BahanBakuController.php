<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanbaku = BahanBaku::all();
        return view('bahanbaku.index', compact("bahanbaku"));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $material = new BahanBaku;
        $material->kode_material = $request->kode_material;
        $material->nama_material = $request->nama_material;
        $material->jumlah_material = 0;
        $material->jenis_material = $request->jenis_material;
        $material->save();
        Alert::success('Tersimpan', 'Barang Berhasil Disimpan');
        return redirect()->route('bahan-baku.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $bahanbaku = BahanBaku::findOrFail($id);
        return view("bahanbaku.edit", compact('bahanbaku'));
    }


    public function update(Request $request, $id)
    {
        $material = BahanBaku::findOrFail($id);
        $material->kode_material = $request->kode_material;
        $material->nama_material = $request->nama_material;
        $material->jenis_material = $request->jenis_material;
        $material->jumlah_material = 0;
        $material->save();
        Alert::success('Terupdate', 'Barang Berhasil Diupdate');
        return redirect()->route('bahan-baku.index');
    }


    public function delete($id)
    {
        $barang = BahanBaku::findOrFail($id);
        $barang->delete();
        Alert::success('Terhapus', 'Barang Berhasil Dihapus');
        return redirect()->route('bahan-baku.index');
    }
}