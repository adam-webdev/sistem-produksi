<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\PermintaanBahanBaku;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermintaanBahanBakuController extends Controller
{
    public function index()
    {
        $bahanbaku = BahanBaku::all();
        $data = PermintaanBahanBaku::with('bahanbaku')->get();
        return view('produksi.permintaan_bahanbaku.index', compact("data", "bahanbaku"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = new PermintaanBahanBaku();
        $data->bahanbaku_id = $request->bahanbaku_id;
        $data->jumlah_material = $request->jumlah_material;
        $data->status = "Belum Di ACC";
        $data->save();
        Alert::success("Tersimpan", "Data Berhasil Disimpan");
        return redirect()->route('permintaan-bahanbaku.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = PermintaanBahanBaku::findOrFail($id);
        $bahanbaku = BahanBaku::all();
        return view("produksi.permintaan_bahanbaku.edit", compact("data", "bahanbaku"));
    }

    public function update(Request $request, $id)
    {
        $data = PermintaanBahanBaku::findOrFail($id);
        $data->bahanbaku_id = $request->bahanbaku_id;
        $data->jumlah_material = $request->jumlah_material;
        $data->status = $data->status;
        $data->save();
        Alert::success("Terupdate", "Data Berhasil Diupdate");
        return redirect()->route('permintaan-bahanbaku.index');
    }


    public function delete($id)
    {
        $data = PermintaanBahanBaku::findOrFail($id);
        $data->delete();
        Alert::success("Terhapus", "Data Berhasil Dihapus");
        return redirect()->route('Permintaan-bahanbaku.index');
    }

    // cek permintaan gudang

    public function cek_permintaan()
    {
        $bahanbaku = BahanBaku::all();
        $data = PermintaanBahanBaku::with('bahanbaku')->get();
        return view('gudang.cek_permintaan.index', compact("data", "bahanbaku"));
    }
    public function edit_permintaan($id)
    {
        $data = PermintaanBahanBaku::findOrFail($id);
        return view("gudang.cek_permintaan.edit", compact("data"));
    }

    public function update_permintaan(Request $request, $id)
    {
        $data = PermintaanBahanBaku::findOrFail($id);
        $data->status = $request->status;
        $data->save();
        Alert::success("Terupdate", "Data Berhasil Diupdate");
        return redirect()->route('cek-permintaan.index');
    }
}