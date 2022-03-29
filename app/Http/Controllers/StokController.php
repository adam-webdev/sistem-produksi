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
        return view('gudang.stok.index', compact("stok", "bahanbaku"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $id = Stok::where('bahanbaku_id', $request->bahanbaku_id)->first();
        // jika finish good sudah ada tambahkan jumlahnya
        if ($id) {
            $data = Stok::findOrFail($request->bahanbaku_id);
            $data->bahanbaku_id =  $data->bahanbaku_id;
            $data->satuan =  $data->satuan;
            $data->jumlah_material = $data->jumlah_material + $request->jumlah;
            $data->save();
            Alert::success("Tersimpan", "Jumlah Stok Bahan Baku Berhasil Ditambah");
            return redirect()->route('stok.index');
        }

        $stok = new Stok();
        $stok->bahanbaku_id = $request->bahanbaku_id;
        $stok->jumlah_material = $request->jumlah;
        $stok->satuan = $request->satuan;
        $stok->save();
        Alert::success("Tersimpan", "Stok Bahan Baku Berhasil Disimpan");
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
        return view("gudang.stok.edit", compact("stok", "bahanbaku"));
    }

    public function update(Request $request, $id)
    {
        $stok = Stok::findOrFail($id);
        $stok->bahanbaku_id = $request->bahanbaku_id;
        $stok->jumlah_material = $stok->jumlah_material;
        $stok->satuan = $request->satuan;
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