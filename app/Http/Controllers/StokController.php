<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Stok;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StokController extends Controller
{
    public function index()
    {
        $bahanbaku = BahanBaku::all();
        $stok = Stok::with('bahanbaku', 'bahanbakukeluar', 'bahanbakumasuk')->get();
        return view('stok.index', compact("stok", "bahanbaku"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $stok = new Stok;
        $stok->bahanbaku_id = $request->bahanbaku_id;
        $stok->jumlah_material = 0;

        $stok->save();
        Alert::success("Tersimpan", "Stok Berhasil Disimpan");
        return redirect()->route('stok.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $stok = Stok::findOrFail($id);
        $bahanbaku = BahanBaku::all();
        return view("stok.edit", compact("stok", "bahanbaku"));
    }

    public function update(Request $request, $id)
    {
        $stok = Stok::findOrFail($id);
        $stok->bahanbaku_id = $request->bahanbaku_id;
        $stok->jumlah_material = $stok->jumlah_material;
        $stok->save();
        Alert::success("Terupdate", "Data Berhasil Diupdate");
        return redirect()->route('stok.index');
    }


    public function delete($id)
    {
        $stok = Stok::findOrFail($id);
        $stok->delete();
        Alert::success("Terhapus", "Stok Berhasil Dihapus");
        return redirect()->route('stok.index');
    }
}