<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\BahanBakuKeluar;
use App\Models\BahanBakuMasuk;
use App\Models\FinishGood;
use App\Models\JadwalProduksi;
use App\Models\PencatatanProduksi;
use App\Models\PermintaanBahanBaku;
use App\Models\Stok;
use App\Models\StokFinishGood;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function view_bahanbaku()
    {
        return view('admin.bahanbaku.laporan.laporan');
    }

    public function bahan_baku(Request $request)
    {
        $this->middleware('role:Admin|Direktur');
        $periode = $request->periode;
        if ($periode == "all") {
            $data = BahanBaku::all();
            $pdf = PDF::loadView('admin.bahanbaku.laporan.print', compact('data', 'periode'))->setPaper('A4');
            return $pdf->stream('laporan-bahan-baku-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = BahanBaku::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadView('admin.bahanbaku.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('A4');
            return $pdf->stream('laporan-bahanbaku-perperiode.pdf');
        }
    }

    public function view_bahanbaku_keluar()
    {
        return view('gudang.bahanbaku_keluar.laporan.laporan');
    }

    public function bahan_baku_keluar(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = BahanBakuKeluar::with("stok")->get();
            $pdf = PDF::loadview('gudang.bahanbaku_keluar.laporan.print', compact('data', 'periode'));
            return $pdf->stream('laporan-bahanbaku-keluar-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = BahanBakuKeluar::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('gudang.bahanbaku_keluar.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'));
            return $pdf->stream('laporan-bahanbaku-keluar-perperiode.pdf');
        }
    }

    public function view_bahanbaku_masuk()
    {
        return view('gudang.bahanbaku_masuk.laporan.laporan');
    }

    public function bahan_baku_masuk(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = BahanBakuMasuk::with("stok")->get();
            $pdf = PDF::loadview('gudang.bahanbaku_masuk.laporan.print', compact('data', 'periode'))->setPaper('A4');
            return $pdf->stream('laporan-bahanbaku-masuk-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = BahanBakuMasuk::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('gudang.bahanbaku_masuk.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('A4');
            return $pdf->stream('laporan-bahanbaku-masuk-perperiode.pdf');
        }
    }

    public function view_finishgood()
    {
        return view('admin.finishgood.laporan.laporan');
    }

    public function finish_good(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = FinishGood::all();
            $pdf = PDF::loadview('admin.finishgood.laporan.print', compact('data', 'periode'))->setPaper('A4');
            return $pdf->stream('laporan-finishgood-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = FinishGood::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('admin.finishgood.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('A4');
            return $pdf->stream('laporan-finishgood-perperiode.pdf');
        }
    }

    public function view_jadwalproduksi()
    {
        return view('gudang.jadwal_produksi.laporan.laporan');
    }
    public function jadwal_produksi(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = JadwalProduksi::with('stokfinishgood')->get();
            $pdf = PDF::loadview('gudang.jadwal_produksi.laporan.print', compact('data', 'periode'))->setPaper('A4');
            return $pdf->stream('laporan-jadwal-produksi-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = JadwalProduksi::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('gudang.jadwal_produksi.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('A4');
            return $pdf->stream('laporan-jadwal-produksi-perperiode.pdf');
        }
    }
    public function view_pencatatanproduksi()
    {
        return view('produksi.pencatatan_produksi.laporan.laporan');
    }
    public function pencatatan_produksi(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = PencatatanProduksi::with('jadwalproduksi', 'stokfinishgood')->get();
            $pdf = PDF::loadview('produksi.pencatatan_produksi.laporan.print', compact('data', 'periode'))->setPaper('a4', 'landscape');
            return $pdf->stream('laporan-pencatatan-produksi-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = PencatatanProduksi::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('produksi.pencatatan_produksi.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('a4', 'landscape');
            return $pdf->stream('laporan-pencatatan-produksi-perperiode.pdf');
        }
    }

    public function view_permintaanbahanbaku()
    {
        return view('produksi.permintaan_bahanbaku.laporan.laporan');
    }

    public function permintaan_bahan_baku(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = PermintaanBahanBaku::with('bahanbaku')->get();
            $pdf = PDF::loadview('produksi.permintaan_bahanbaku.laporan.print', compact('data', 'periode'))->setPaper('A4');
            return $pdf->stream('laporan-permintaan-bahanbaku-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = PermintaanBahanBaku::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('produksi.permintaan_bahanbaku.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('A4');
            return $pdf->stream('laporan-permintaan-bahanbaku-perperiode.pdf');
        }
    }

    public function view_stok()
    {
        return view('gudang.stok.laporan.laporan');
    }
    public function stok(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = Stok::with('bahanbaku')->get();
            $pdf = PDF::loadview('gudang.stok.laporan.print', compact('data', 'periode'))->setPaper('A4');
            return $pdf->stream('laporan-stok-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = Stok::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('gudang.stok.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('A4');
            return $pdf->stream('laporan-stok-perperiode.pdf');
        }
    }
    public function view_stokfinishgood()
    {
        return view('gudang.stokfinishgood.laporan.laporan');
    }
    public function stokfinishgood(Request $request)
    {
        $periode = $request->periode;
        if ($periode == "all") {
            $data = StokFinishGood::with('finishgood')->get();
            $pdf = PDF::loadview('gudang.stokfinishgood.laporan.print', compact('data', 'periode'))->setPaper('A4');
            return $pdf->stream('laporan-stokfinishgood-all.pdf');
        } else if ($periode == "periode") {
            $tgl_awal = $request->awal;
            $tgl_akhir = $request->akhir;
            $data = StokFinishGood::whereBetween('created_at', [$tgl_awal, $tgl_akhir])
                ->orderBy('created_at', 'ASC')->get();
            $pdf = PDF::loadview('gudang.stokfinishgood.laporan.print', compact('data', 'periode', 'tgl_awal', 'tgl_akhir'))->setPaper('A4');
            return $pdf->stream('laporan-stokfinishgood-perperiode.pdf');
        }
    }
}