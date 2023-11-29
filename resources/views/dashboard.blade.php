@extends('layouts.layout')
@section('title', 'Dashboard')
@section('css')
    <style>
        .cardMenu {
            box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, .14), 0px 1px 4px 0px rgba(0, 0, 0, .12);
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

    <div class="row">
        <div class="col-md-5">
            <div class="card p-4 mt-4">
                <div class="d-flex">
                    <h5 class="text-dark">Produk Terlaris </h5>
                    <div class="form-group ml-4">
                        <select type="text" name="bulan" id="bulan">
                            <option value="">--pilih bulan--</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        @php
                            $tahun_sekarang = date('Y');
                            $tahun_list = range($tahun_sekarang - 5, $tahun_sekarang);

                        @endphp
                        <select type="number" name="tahun" id="tahun" class="ml-3">
                            <option value="">--pilih tahun--</option>
                            @foreach ($tahun_list as $tahun)
                                <option value="{{ $tahun }}">{{ $tahun }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="font-weight-bold">
                            <td>No</td>
                            <td>Nama Produk</td>
                            <td>Jumlah Terjual</td>
                            <td>Bulan</td>
                            <td>Tahun</td>
                        </tr>
                        <tbody id="data-produk">
                            @foreach ($produk_terlaris as $pt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pt->nama_fg }}</td>
                                    <td>{{ $pt->jumlah_penjualan }}</td>
                                    <td>{{ $pt->bulan }}</td>
                                    <td>{{ $pt->tahun }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#bulan, #tahun').on('change', function() {
                var bulan = $('#bulan').val()
                var tahun = $('#tahun').val()
                console.log(bulan)
                console.log(tahun)
                $.ajax({
                    type: 'GET',
                    url: "{{ route('produkterlaris') }}",
                    data: {
                        bulan: bulan,
                        tahun: tahun
                    },
                    success: function(data) {
                        console.log("data : ", data)

                        if (data.length == 0) {
                            $('#data-produk').html(`
                               <tr align="center"><td colspan="5">Data tidak ditemukan!</td></tr>
                            `)
                        } else {
                            $('#data-produk').html(
                                data.map((item, index) => {
                                    return `<tr>
                                                <td>${index+1}</td>
                                                <td>${item.nama_fg}</td>
                                                <td>${item.jumlah_penjualan}</td>
                                                <td>${item.bulan}</td>
                                                <td>${item.tahun}</td>
                                            </tr>`
                                })

                            )
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText)
                    }
                })
            })

        })
    </script>
@endsection
