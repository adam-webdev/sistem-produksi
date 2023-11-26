@extends('layouts.layout')
@section('title', 'Dashboard')
@section('css')
    <style>
        .cardMenu {
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, .14), 0px 1px 4px 0px rgba(0, 0, 0, .12);
            ;
        }

        .jumlah {
            font-weight: 700;
            color: black;
            font-size: 18px;
        }
    </style>

@endsection
@section('content')
    <div class="card p-4">
        <h5>Selamat Datang <b>{{ Auth::user()->name }} </b> di Dashboard Sistem Informasi Produksi</h5>
        <hr>
        <div class="row ">
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class="fas fa-money-bill-alt text-primary" style="font-size:40px"></i></p>
                            <p>Penjualan</p>
                        </span>
                        <span>
                            <p class="jumlah text-success">@currency($penjualan_total)</p>
                            <a href="{{ route('penjualan.index') }}" class="text-dark">Detail <i
                                    class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class=" fas fa-shopping-basket text-primary" style="font-size:40px"></i></p>
                            <p>Pembelian</p>
                        </span>
                        <span>
                            <p class="jumlah text-danger">@currency($pembelian_total)</p>
                            <a href="{{ route('pembelian.index') }}" class="text-dark">Detail <i
                                    class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class=" fas fa-book text-primary" style="font-size:40px"></i></p>
                            <p>Hutang</p>
                        </span>
                        <span>
                            <p class="jumlah text-danger">@currency($hutang)</p>
                            <a href="" class="text-dark">Detail <i class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-2 cardMenu">
                    <div class="d-flex align-items-center">
                        <span class="p-2 mr-4" style="background: rgba(240, 240, 240, 0.661)">
                            <p><i class="fas fa-credit-card text-primary" style="font-size:40px"></i></p>
                            <p>Piutang</p>
                        </span>
                        <span>
                            <p class="jumlah text-success">@currency($piutang)</p>
                            <a href="" class="text-dark">Detail <i class="fas fa-arrow-right"></i></a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row align-items-center">
        <div class="col-md-4 ml-4">
            <img width="400px" height="400px" src="{{asset("asset/img/company.svg")}}" alt="">
        </div>
        <div class="col-md-6">
            <div class="card p-4">
            @foreach ($perusahaan as $perusahaan)
                <h4>{{$perusahaan->nama_usaha}}</h4>
                <p>{{$perusahaan->alamat}}</p>
                <p>{{$perusahaan->email}}</p>
                <p>{{$perusahaan->telepon}}</p>
            @endforeach

        </div>

        </div>
    </div> --}}
@endsection
