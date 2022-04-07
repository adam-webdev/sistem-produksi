<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class BahanBakuController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin|Direktur');
    }
    public function index()
    {
        $supplier = Supplier::all();
        $bahanbaku = BahanBaku::with('supplier')->get();
        return view('admin.bahanbaku.index', compact("bahanbaku", "supplier"));
    }

    public function pembelian()
    {
        $bahanbaku = BahanBaku::with('supplier')->get();
        return view('admin.transaksi.pembelian.index', compact("bahanbaku"));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kode_material' => 'required|unique:bahan_bakus',
        ]);

        if ($validator->fails()) {
            return redirect()->route('bahan-baku.index')
                ->withErrors($validator)
                ->withInput();
        }

        $material = new BahanBaku;
        $material->kode_material = $request->kode_material;
        $material->supplier_id = $request->supplier_id;
        $material->nama_material = $request->nama_material;
        $material->harga = $request->harga;
        $material->jenis_material = $request->jenis_material;
        $material->jumlah_material = $request->jumlah_material;
        $material->satuan = $request->satuan;
        $material->save();
        Alert::success('Tersimpan', 'Barang Berhasil Disimpan');
        return redirect()->route('bahan-baku.index');
    }


    public function detail($id)
    {
        $bahanbaku = BahanBaku::findOrFail($id);
        return view("admin.transaksi.pembelian.detail", compact('bahanbaku'));
    }


    public function edit($id)
    {
        $supplier = Supplier::all();
        $bahanbaku = BahanBaku::findOrFail($id);
        return view("admin.bahanbaku.edit", compact('bahanbaku', 'supplier'));
    }


    public function update(Request $request, $id)
    {
        $material = BahanBaku::findOrFail($id);
        $material->kode_material = $request->kode_material;
        $material->supplier_id = $request->supplier_id;
        $material->nama_material = $request->nama_material;
        $material->harga = $request->harga;
        $material->jenis_material = $request->jenis_material;
        $material->jumlah_material = $request->jumlah_material;
        $material->satuan = $request->satuan;
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