<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('role:Admin|Direktur|Gudang');
    }

    public function index()
    {
        $bahanbaku = BahanBaku::all();
        $bahanbaku_keluar = BahanBakuKeluar::with('bahanbaku')->get();
        return view('gudang.bahanbaku_keluar.index', compact("bahanbaku_keluar", "bahanbaku"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $bahanbaku_keluar = new BahanBakuKeluar;
        $bahanbaku_keluar->bahanbaku_id = $request->bahanbaku_id;
        $bahanbaku_keluar->jumlah = $request->jumlah;
        $bahanbaku_keluar->tanggal = $request->tanggal;
        $bahanbaku = BahanBaku::select("jumlah_material")->where("id", $request->bahanbaku_id)->get();
        $bahanbaku = $bahanbaku[0]->jumlah_material;

        if ($request->jumlah <= $bahanbaku) {
            $bahanbaku_keluar->save();
            Alert::success("Tersimpan", "Data Berhasil Disimpan");
            return redirect()->route('bahanbaku-keluar.index');
        } else {
            Alert::error("Gagal", "Jumlah barang tidak cukup maksimal {{$bahanbaku}} ");
            return redirect()->route('bahanbaku-keluar.index');
        }
    }

    public function show($id)
    {
        //
    }

    // public function edit($id)
    // {
    //     $bahanbaku_keluar = BahanBakuKeluar::findOrFail($id);
    //     $bahanbaku = BahanBaku::all();
    //     return view("gudang.bahanbaku_keluar.edit", compact("bahanbaku_keluar", "bahanbaku"));
    // }

    // public function update(Request $request, $id)
    // {
    //     $bahanbaku_keluar = BahanBakuKeluar::findOrFail($id);
    //     $bahanbaku_keluar->bahanbaku_id = $request->bahanbaku_id;
    //     $bahanbaku_keluar->jumlah = $request->jumlah;
    //     $bahanbaku_keluar->save();
    //     Alert::success("Terupdate", "Data Berhasil Diupdate");
    //     return redirect()->route('bahanbaku-keluar.index');
    // }


    public function delete($id)
    {
        $bahanbaku_keluar = BahanBakuKeluar::findOrFail($id);
        $bahanbaku_keluar->delete();
        Alert::success("Terhapus", "Data Berhasil Dihapus");
        return redirect()->route('bahanbaku-keluar.index');
    }
}