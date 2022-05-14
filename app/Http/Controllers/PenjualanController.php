<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FinishGood;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Piutang;
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
        $penjualan = Penjualan::with('penjualandetail.customer')->get();
        // ddd($penjualan);
        $customer = Customer::all();
        return view('admin.transaksi.penjualan.index', compact('finishgood', 'penjualan', 'no', 'customer'));
    }



    public function penjualan_detail($id)
    {
        $penjualan_detail = PenjualanDetail::where('penjualan_id', $id)->get();
        $kredit = $penjualan_detail[0]->jenis_pembayaran === "Kredit" ? $penjualan_detail[0]->tanggal_pembayaran : '-';
        return view('admin.transaksi.penjualan_detail.detail', compact('penjualan_detail', 'kredit'));
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


        $finishgood = $request->input('finishgood_id', []);
        $jumlah = $request->input('jumlah', []);

        $penjualan_detail = [];
        // harga Fg array
        $hargaFG = [];
        // stock Fg array
        $stokfg = [];

        // loop & get total hargaFg, stokFg, namaFg
        foreach ($finishgood as $fg) {
            $hargaFG[] = FinishGood::select('harga')->where('id', $fg)->sum('harga');
            $stokfg[] = FinishGood::select('jumlah_fg')->where('id', $fg)->sum('jumlah_fg');
            $namaFg[] = FinishGood::select('nama_fg')->where('id', $fg)->pluck('nama_fg');
        }

        $result = [];
        // get hargaFg * request jumlah

        // result = [
        //     20000,      item1
        //     300000      item2
        // ]
        foreach ($hargaFG as $index => $value) {
            $result[$index] = $value * $jumlah[$index];
        }

        foreach ($stokfg as $index => $value) {
            if ($jumlah[$index] > $stokfg[$index]) {
                Alert::error("Gagal", "Jumlah stok fg {{$namaFg[$index]}} tidak cukup maksimal {{$stokfg[$index]}} ");
                return redirect()->route('penjualan.index');
            }
        }

        $total = array_sum($result);
        $tanggal = '';

        if ($request->jenis_pembayaran === 'Cash') {
            $tanggal = Carbon::now();
        } else {
            $tanggal = Carbon::now()->addDay(30);
        }

        // save penjualan & get id penjualans
        $penjualan_id = DB::table('penjualans')->insertGetId($penjualan);

        foreach ($finishgood as $index => $value) {
            $penjualan_detail[] = [
                'penjualan_id' => $penjualan_id,
                'finishgood_id' => $finishgood[$index],
                'jumlah' => $jumlah[$index],
                'customer_id' => $request->customer_id,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'tanggal_pembayaran' => $tanggal,
                'harga' => $hargaFG[$index],
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'total_pembayaran' => $result[$index],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        DB::table('penjualan_details')->insert($penjualan_detail);

        if ($request->jenis_pembayaran === 'Kredit') {
            $piutang = new Piutang();
            $piutang->penjualan_id = $penjualan_id;
            $piutang->total = $total;
            $piutang->save();
        }
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
        $customer = Customer::all();
        $penjualan = Penjualan::findOrFail($id);
        $penjualandetail = PenjualanDetail::where('penjualan_id', $id)->get();
        $finishgood = FinishGood::all();

        return view('admin.transaksi.penjualan.edit', compact('penjualan', 'penjualandetail', 'customer', 'finishgood'));
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
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->tanggal_penjualan = $request->tanggal_penjualan;
        $penjualan->keterangan = $request->keterangan;

        $finishgood = $request->input('finishgood_id', []);
        $jumlah = $request->input('jumlah', []);
        if (empty($finishgood)) {
            Alert::error('gagal', 'Silahkan pilih Finish good terlebih dahulu');
            return redirect()->route('penjualan.edit', [$id]);
        }
        DB::beginTransaction();

        PenjualanDetail::where('penjualan_id', $id)->delete();
        $penjualan->save();
        // $id_penjualan = (array) PenjualanDetail::select('id')->where('penjualan_id', $id)->get();
        // ddd(gettype($id_penjualan[0]));

        $penjualan_detail = [];
        // harga Fg array
        $hargaFG = [];
        // stock Fg array
        $stokfg = [];

        // loop & get total hargaFg, stokFg, namaFg
        foreach ($finishgood as $fg) {
            $hargaFG[] = FinishGood::select('harga')->where('id', $fg)->sum('harga');
            $stokfg[] =  FinishGood::select('jumlah_fg')->where('id', 2)->get('jumlah_fg');
            $namaFg[] = FinishGood::select('nama_fg')->where('id', $fg)->pluck('nama_fg');
        }

        $result = [];
        // get hargaFg * request jumlah

        // result = [
        //     20000,      item1
        //     300000      item2
        // ]
        foreach ($hargaFG as $index => $value) {
            $result[$index] = $value * $jumlah[$index];
        }

        foreach ($stokfg as $index => $value) {
            if ($jumlah[$index] > $stokfg[$index]) {
                Alert::error("Gagal", "Jumlah stok fg {{$namaFg[$index]}} tidak cukup maksimal {{$stokfg[$index]}} ");
                DB::rollBack();
                return redirect()->route('penjualan.index');
            }
        }

        $total = array_sum($result);
        $tanggal = '';

        if ($request->jenis_pembayaran === 'Cash') {
            $tanggal = Carbon::now();
        } else {
            $tanggal = Carbon::now()->addDay(30);
        }

        // save penjualan & get id penjualans

        foreach ($finishgood as $index => $value) {
            $penjualan_detail[] = [
                'penjualan_id' => $id,
                'finishgood_id' => $finishgood[$index],
                'jumlah' => $jumlah[$index],
                'customer_id' => $request->customer_id,
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'tanggal_pembayaran' => $tanggal,
                'harga' => $hargaFG[$index],
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'total_pembayaran' => $result[$index],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            // PenjualanDetail::whereIn('penjualan_id', $id[$index])->update($penjualan_detail[$index]);
        }
        // ddd($penjualan_detail[1]);
        // foreach ($id_penjualan as $index => $idp) {
        //     // ddd($idp);
        // }
        // ddd($idp);
        // ddd($penjualan_detail);

        DB::table('penjualan_details')->insert($penjualan_detail);

        $cek_piutang =  Piutang::where('penjualan_id', $id)->get(); // array
        $id_piutang = '';
        foreach ($cek_piutang as $h) {
            $id_piutang = $h->id;
        }
        if ($request->jenis_pembayaran === 'Kredit') {
            if ($id_piutang === "") {
                $piutang = new Piutang();
                $piutang->pembelian_id = $id;
                $piutang->total = array_sum($result);
                $piutang->save();
            } else {
                $data_piutang = Piutang::findOrFail($id_piutang);
                $data_piutang->total = array_sum($result);
                $data_piutang->save();
            }
        } else {
            Piutang::where('penjualan_id', $id)->delete();
        }
        DB::commit();
        Alert::success('Berhasil', 'Data Berhasil Diupdate');
        return redirect()->route('penjualan.index');
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