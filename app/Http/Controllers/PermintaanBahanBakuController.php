<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\PermintaanBahanBaku;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PermintaanBahanBakuController extends Controller
{
    public function index()
    {
        $kodeGenerator = PermintaanBahanBaku::kode();
        $bahanbaku = BahanBaku::all();
        $data = PermintaanBahanBaku::with('bahanbaku')->get();
        return view('produksi.permintaan_bahanbaku.index', compact("data", "bahanbaku", "kodeGenerator"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {


        $bahanbaku = $request->input('bahanbaku_id', []);
        $jumlah_material = $request->input('jumlah_material', []);

        foreach ($bahanbaku as $index => $value) {
            $datas[] = [
                'bahanbaku_id' => $bahanbaku[$index],
                'jumlah_material' => $jumlah_material[$index],
                'status' => "Belum Di ACC",
                'tanggal' => $request->date,
                'kode' => $request->kode,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'kode' => $request->kode,
            ];
        }
        PermintaanBahanBaku::insert($datas);
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
        $data->kode = $data->kode;
        $data->tanggal = $data->date;
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
        return redirect()->route('permintaan-bahanbaku.index');
    }

    // cek permintaan gudang

    public function cek_permintaan()
    {
        $bahanbaku = BahanBaku::all();
        $data = PermintaanBahanBaku::with('bahanbaku')->get();
        $dataFilter = 0;
        return view('gudang.cek_permintaan.index', compact("data", "dataFilter", "bahanbaku"));
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
    public function filter_tanggal(Request $request)
    {
        $dataFilter = PermintaanBahanBaku::whereBetween('tanggal', [$request->from_tanggal, $request->to_tanggal])->orderBy('tanggal', 'ASC')->get();
        return view('gudang.cek_permintaan.index', compact("dataFilter"));
    }
}