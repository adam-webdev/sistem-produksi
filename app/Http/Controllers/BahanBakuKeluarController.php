<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use App\Models\PermintaanBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $permintaan = PermintaanBahanBaku::all();
        $bahanbaku_keluar = BahanBakuKeluar::with('bahanbaku')->get();
        return view('gudang.bahanbaku_keluar.index', compact("bahanbaku_keluar", "permintaan"));
    }

    public function create()
    {
        //
    }


    public function bahanbakukeluarid(Request $request)
    {
        // if (request()->ajax()) {
        // return $request->supp_id;?
        // }
        return PermintaanBahanBaku::where('kode', $request->kode)->with('bahanbaku')->get();
        // return view('admin.transaksi.pembelian.index', compact('data'));
    }
    public function store(Request $request)
    {

        $bahanbaku = $request->input('bahanbaku_id', []);
        $jumlah =  $request->input('jumlah', []);
        // $data = PembelianDetail::where('pembelian_id', $request->pembelian)->get();

        // if ($data) {
        foreach ($bahanbaku as $index => $value) {
            $data[] = [
                "bahanbaku_id" => $bahanbaku[$index],
                "jumlah" => $jumlah[$index],
                "tanggal" => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $namabahanbaku[$index] = BahanBaku::select('nama_material')->where('id', $bahanbaku[$index])->pluck('nama_material');

            $bahanbaku_jumlah[$index] = BahanBaku::select("jumlah_material")->where("id", $bahanbaku[$index])->sum('jumlah_material');

            if ($jumlah[$index] > $bahanbaku_jumlah[$index]) {
                Alert::error("Gagal", "Jumlah stok fg {{$namabahanbaku[$index]}} tidak cukup maksimal {{$bahanbaku_jumlah[$index]}} ");
                return redirect()->route('bahanbaku-keluar.index');
            }
        }
        DB::table('bahan_baku_keluars')->insert($data);
        // $bahanbaku_masuk->bahanbaku_id = 22;
        Alert::success("Tersimpan", "Data Berhasil Disimpan");
        return redirect()->route('bahanbaku-keluar.index');

        // $data = PermintaanBahanBaku::where('kode', $request->kode)->get();
        // if ($data) {
        //     $bahanbaku_jumlah = [];
        //     $namabahanbaku = [];
        //     foreach ($data as $index => $value) {
        //         $bahanbaku[] = [
        //             "bahanbaku_id" => $data[$index]->bahanbaku_id,
        //             "jumlah" => $data[$index]->jumlah_material,
        //             "tanggal" => Carbon::now(),
        //             'created_at' => Carbon::now(),
        //             'updated_at' => Carbon::now()
        //         ];
        //         $namabahanbaku[$index] = BahanBaku::select('nama_material')->where('id', $data[$index]->bahanbaku_id)->pluck('nama_material');

        //         $bahanbaku_jumlah[$index] = BahanBaku::select("jumlah_material")->where("id", $data[$index]->bahanbaku_id)->sum('jumlah_material');

        //         if ($data[$index]->jumlah > $bahanbaku_jumlah[$index]) {
        //             Alert::error("Gagal", "Jumlah stok fg {{$namabahanbaku[$index]}} tidak cukup maksimal {{$bahanbaku_jumlah[$index]}} ");
        //             return redirect()->route('bahanbaku-keluar.index');
        //         }
        //     }
        //     // if()
        //     DB::table('bahan_baku_keluars')->insert($bahanbaku);
        // }
        // // $bahanbaku_masuk->bahanbaku_id = 22;
        // Alert::success("Tersimpan", "Data Berhasil Disimpan");
        // return redirect()->route('bahanbaku-keluar.index');
        // $bahanbaku_keluar = new BahanBakuKeluar;
        // $bahanbaku_keluar->bahanbaku_id = $request->bahanbaku_id;
        // $bahanbaku_keluar->jumlah = $request->jumlah;
        // $bahanbaku_keluar->tanggal = $request->tanggal;
        // $bahanbaku = BahanBaku::select("jumlah_material")->where("id", $request->bahanbaku_id)->get();
        // $bahanbaku = $bahanbaku[0]->jumlah_material;

        // if ($request->jumlah <= $bahanbaku) {
        //     $bahanbaku_keluar->save();
        //     Alert::success("Tersimpan", "Data Berhasil Disimpan");
        //     return redirect()->route('bahanbaku-keluar.index');
        // } else {
        //     Alert::error("Gagal", "Jumlah barang tidak cukup maksimal {{$bahanbaku}} ");
        //     return redirect()->route('bahanbaku-keluar.index');
        // }
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