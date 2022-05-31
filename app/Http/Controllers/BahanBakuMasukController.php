<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BahanBakuMasuk;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuMasukController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Direktur|Gudang');
    }

    public function index()
    {
        // $bahanbaku = Bahanbaku::all();
        $bahanbaku_masuk = BahanBakuMasuk::with('bahanbaku')->orderBy('created_at', 'desc')->get();
        $pembelian = Pembelian::with('pembeliandetail')->get();
        // ddd($pembelian);
        return view('gudang.bahanbaku_masuk.index', compact("pembelian", "bahanbaku_masuk"));
    }

    public function create()
    {
    }


    public function store(Request $request)
    {

        $data = PembelianDetail::where('pembelian_id', $request->pembelian)->get();

        if ($data) {
            foreach ($data as $index => $value) {
                $bahanbaku[] = [
                    "bahanbaku_id" => $data[$index]->bahanbaku_id,
                    "jumlah" => $data[$index]->jumlah,
                    "tanggal" => $data[$index]->tanggal_pembelian,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
            }
            DB::table('bahan_baku_masuks')->insert($bahanbaku);
        }
        // $bahanbaku_masuk->bahanbaku_id = 22;
        Alert::success("Tersimpan", "Data Berhasil Disimpan");
        return redirect()->route('bahanbaku-masuk.index');
    }

    public function show($id)
    {
        //
    }

    // public function edit($id)
    // {
    //     $bahanbaku_masuk = BahanBakuMasuk::findOrFail($id);
    //     $bahanbaku = BahanBaku::all();
    //     return view("bahanbaku_masuk.edit", compact("bahanbaku_masuk", "bahanbaku"));
    // }

    // public function update(Request $request, $id)
    // {
    //     $bahanbaku_masuk = BahanBakuMasuk::findOrFail($id);
    //     $bahanbaku_masuk->stok_id = $request->stok_id;
    //     $bahanbaku_masuk->jumlah = $request->jumlah;
    //     $bahanbaku_masuk->save();
    //     Alert::success("Terupdate", "Data Berhasil Diupdate");
    //     return redirect()->route('bahanbaku-masuk.index');
    // }

    public function delete($id)
    {
        $bahanbaku_masuk = BahanBakuMasuk::findOrFail($id);
        $bahanbaku_masuk->delete();
        Alert::success("Terhapus", "Data Berhasil Dihapus");
        return redirect()->route('bahanbaku-masuk.index');
    }
}