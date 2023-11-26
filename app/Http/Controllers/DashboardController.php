<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use App\Models\Pembelian;
use App\Models\Penjualan;
use App\Models\Piutang;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $penjualan_total = Penjualan::select('total')->sum('total');
        $pembelian_total = Pembelian::select('total')->sum('total');
        $hutang = Hutang::select('total')->sum('total');
        $piutang = Piutang::select('total')->sum('total');

        return view('dashboard', compact('penjualan_total', 'pembelian_total', 'hutang', 'piutang'));
    }
}