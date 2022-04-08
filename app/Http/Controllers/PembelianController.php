<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = Pembelian::NoPembelian();
        $supplier = Supplier::all();
        $bahanbaku = BahanBaku::all();
        $pembelian = Pembelian::all();
        return view('admin.transaksi.pembelian.index', compact('supplier', 'bahanbaku', 'pembelian', 'no'));
    }

    public function bahanbakuid(Request $request)
    {
        // if (request()->ajax()) {
        // return $request->supp_id;?
        // }
        return BahanBaku::where('supplier_id', $request->supp_id)->get();
        // return view('admin.transaksi.pembelian.index', compact('data'));
    }

    public function pembelian_detail($id)
    {
        $pembelian_detail = PembelianDetail::where('pembelian_id', $id)->get();
        return view('admin.transaksi.pembelian_detail.detail', compact('pembelian_detail'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pembelian = [
            'no_pembelian' => $request->no_pembelian,
            'tanggal_pembelian' => $request->tanggal_pembelian,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $pembelian_id = DB::table('pembelians')->insertGetId($pembelian);

        $bahanbaku = $request->input('bahanbaku_id', []);
        $jumlah = $request->input('jumlah', []);

        $pembelian_detail = [];

        $tanggal = '';

        if ($request->jenis_pembayaran === 'Cash') {
            $tanggal = Carbon::now();
        } else {
            $tanggal = Carbon::now()->addDay(30);
        }
        foreach ($bahanbaku as $index => $value) {
            $pembelian_detail[] = [
                'pembelian_id' => $pembelian_id,
                'bahanbaku_id' => $bahanbaku[$index],
                'jumlah' => $jumlah[$index],
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'tanggal_pembayaran' => $tanggal,
                'total_pembayaran' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        $data = DB::table('pembelian_details')->insert($pembelian_detail);
        Alert::success('Berhasil', 'Data Berhasil Disimpan');
        return redirect()->route('pembelian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pembelian::findOrFail($id);
        $data->delete();
        Alert::success("Terhapus", "Data Berhasil Dihapus");
        return redirect()->route('pembelian.index');
    }
}