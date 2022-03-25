<?php

namespace App\Http\Controllers;

use App\Models\FinishGood;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FinishGoodController extends Controller
{
    public function index()
    {
        $data = FinishGood::all();
        return view('admin.finishgood.index', compact("data"));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = new FinishGood;
        $data->kode_fg = $request->kode_fg;
        $data->nama_fg = $request->nama_fg;
        $data->jumlah_fg = $request->jumlah_fg;
        $data->jeniswarna_fg = $request->jeniswarna_fg;
        $data->save();
        Alert::success('Tersimpan', 'Finish Good Berhasil Disimpan');
        return redirect()->route('finish-good.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = FinishGood::findOrFail($id);
        return view("admin.finishgood.edit", compact('data'));
    }


    public function update(Request $request, $id)
    {
        $data = FinishGood::findOrFail($id);
        $data->kode_fg = $request->kode_fg;
        $data->nama_fg = $request->nama_fg;
        $data->jumlah_fg = $request->jumlah_fg;
        $data->jeniswarna_fg = $request->jeniswarna_fg;
        $data->save();
        Alert::success('Tersimpan', 'Finish Good Berhasil Diupdate');
        return redirect()->route('finish-good.index');
    }


    public function delete($id)
    {
        $data = FinishGood::findOrFail($id);
        $data->delete();
        Alert::success('Terhapus', 'Finish Good Berhasil Dihapus');
        return redirect()->route('finish-good.index');
    }
}