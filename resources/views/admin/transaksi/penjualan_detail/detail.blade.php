@extends('layouts.layout')
@section('title', 'Detail Penjualan')
@section('content')
    @include('sweetalert::alert')


    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Penjualan </h1>
        <!-- Button trigger modal -->
    </div>

    <div class="row">
        <div class="col-md-4">
            <label for="nopenjualan">No Penjualan</label>
            <input type="text" class="form-control" id="nopenjualan"
                value="{{ $penjualan_detail[0]->penjualan->no_penjualan }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="tanggal">Tanggal Penjualan</label>
            <input type="text" id="tanggal" class="form-control" value="{{ $penjualan_detail[0]->tanggal_penjualan }}"
                readonly>
        </div>
        <div class="col-md-4">
            <label for="jenis">Jenis Pembayaran</label>
            <input type="text" id="jenis" class="form-control" value="{{ $penjualan_detail[0]->jenis_pembayaran }}"
                readonly>
        </div>
    </div>

    <div class="row mb-4 mt-3">
        <div class="col-md-4">
            <label for="nama">Nama Pelanggan</label>
            <input type="text" id="nama" class="form-control"
                value="{{ $penjualan_detail[0]->penjualan->customer->nama_customer }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="tempo">Tanggal Jatuh Tempo</label>
            <input type="text" id="tempo" class="form-control" value="{{ $kredit }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="ket">Keterangan</label>
            <textarea type="text" rows="5" id="ket" class="form-control" readonly>{{ $penjualan_detail[0]->penjualan->keterangan }}</textarea>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Nama Finish good</th>
                            <th>Kode Finish good </th>
                            {{-- <th>Jenis Pembayaran </th> --}}
                            <th>Jumlah </th>
                            <th>Harga </th>
                            <th>Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan_detail as $pd)
                            <tr align="center">
                                <td>{{ $pd->finishgood->nama_fg }}</td>
                                <td>{{ $pd->finishgood->kode_fg }}</td>
                                {{-- <td>{{ $pd->jenis_pembayaran }}</td> --}}
                                <td>{{ $pd->jumlah }}</td>
                                <td>@currency($pd->harga) </td>
                                {{-- @if ($pd->jenis_pembayaran === 'Cash')
                                    <td>{{ $pd->tanggal_pembayaran }}</td>
                                @else
                                    <td> - </td>
                                @endif

                                @if ($pd->jenis_pembayaran === 'Kredit')
                                    <td>{{ $pd->tanggal_pembayaran }}</td>
                                @else
                                    <td>-</td>
                                @endif --}}
                                <td>@currency($pd->finishgood->harga * $pd->jumlah)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
