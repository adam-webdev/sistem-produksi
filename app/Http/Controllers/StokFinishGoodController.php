<?php

namespace App\Http\Controllers;

use App\Models\FinishGood;
use App\Models\StokFinishGood;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StokFinishGoodController extends Controller
{
    public function index()
    {
        $finishgoods = FinishGood::all();
        $stokfinishgood = StokFinishGood::with('finishgood')->get();
        return view('gudang.stokfinishgood.index', compact("finishgoods", "stokfinishgood"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $id = StokFinishGood::where('finishgood_id', $request->finishgood_id)->first();
        // jika finish good sudah ada tambahkan jumlahnya
        if ($id) {
            $data = StokFinishGood::findOrFail($request->finishgood_id);
            $data->finishgood_id =  $data->finishgood_id;
            $data->satuan =  $data->satuan;
            $data->jumlah = $data->jumlah + $request->jumlah;
            $data->save();
            Alert::success("Tersimpan", "Jumlah Stok Finish Good Berhasil Ditambah");
            return redirect()->route('stokfinishgood.index');
        }

        $stokfinishgood = new StokFinishGood();
        $stokfinishgood->finishgood_id = $request->finishgood_id;
        $stokfinishgood->jumlah = $request->jumlah;
        $stokfinishgood->satuan = $request->satuan;
        $stokfinishgood->save();
        Alert::success("Tersimpan", "Stok Finish Good Berhasil Disimpan");
        return redirect()->route('stokfinishgood.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $stokfinishgood = StokFinishGood::findOrFail($id);
        $finishgoods = FinishGood::all();
        return view("gudang.stokfinishgood.edit", compact("finishgoods", "stokfinishgood"));
    }

    public function update(Request $request, $id)
    {
        $stokfinishgood = StokFinishGood::findOrFail($id);
        $stokfinishgood->finishgood_id = $request->finishgood_id;
        $stokfinishgood->jumlah = $request->jumlah;
        $stokfinishgood->satuan = $request->satuan;

        $stokfinishgood->save();
        Alert::success("Terupdate", "Data Berhasil Diupdate");
        return redirect()->route('stokfinishgood.index');
    }


    public function delete($id)
    {
        $stokfinishgood = StokFinishGood::findOrFail($id);
        $stokfinishgood->delete();
        Alert::success("Terhapus", "Stok Finish Good Berhasil Dihapus");
        return redirect()->route('stokfinishgood.index');
    }
}