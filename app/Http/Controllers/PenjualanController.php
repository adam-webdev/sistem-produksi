<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FinishGood;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PenjualanController extends Controller
{
    public function index()
    {
        $no = Penjualan::NoPenjualan();
        $finishgood = FinishGood::all();
        $penjualan = Penjualan::all();
        $customer = Customer::all();
        return view('admin.transaksi.penjualan.index', compact('finishgood', 'penjualan', 'no', 'customer'));
    }

    // public function bahanbakuid(Request $request)
    // {
    //     // if (request()->ajax()) {
    //     // return $request->supp_id;?
    //     // }
    //     return BahanBaku::where('supplier_id', $request->supp_id)->get();
    //     // return view('admin.transaksi.pembelian.index', compact('data'));
    // }

    public function penjualan_detail($id)
    {
        $penjualan_detail = PenjualanDetail::where('penjualan_id', $id)->get();
        return view('admin.transaksi.penjualan_detail.detail', compact('penjualan_detail'));
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
        $penjualan = [
            'no_penjualan' => $request->no_penjualan,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'keterangan' => $request->keterangan,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $penjualan_id = DB::table('penjualans')->insertGetId($penjualan);

        $finishgood = $request->input('finishgood_id', []);
        $jumlah = $request->input('jumlah', []);

        $penjualan_detail = [];

        $tanggal = '';

        if ($request->jenis_pembayaran === 'Cash') {
            $tanggal = Carbon::now();
        } else {
            $tanggal = Carbon::now()->addDay(30);
        }
        foreach ($finishgood as $index => $value) {
            $penjualan_detail[] = [
                'penjualan_id' => $penjualan_id,
                'finishgood_id' => $finishgood[$index],
                'jumlah' => $jumlah[$index],
                'customer_id' => $request->customer_id,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'tanggal_pembayaran' => $tanggal,
                'total_pembayaran' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        $data = DB::table('penjualan_details')->insert($penjualan_detail);
        Alert::success('Berhasil', 'Data Berhasil Disimpan');
        return redirect()->route('penjualan.index');
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
        $data = Penjualan::findOrFail($id);
        $data->delete();
        Alert::success("Terhapus", "Data Berhasil Dihapus");
        return redirect()->route('penjualan.index');
    }
}