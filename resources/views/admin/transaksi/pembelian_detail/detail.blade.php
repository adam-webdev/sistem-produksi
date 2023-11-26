@extends('layouts.layout')
@section('title', 'Detail Pembelian')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembelian </h1>
        <!-- Button trigger modal -->
    </div>

    <div class="row">
        <div class="col-md-4">
            <label for="nopembelian">No Pembelian</label>
            <input type="text" class="form-control" id="nopembelian"
                value="{{ $pembelian_detail[0]->pembelian->no_pembelian }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="tanggal">Tanggal Pembelian</label>
            <input type="text" id="tanggal" class="form-control" value="{{ $pembelian_detail[0]->tanggal_pembelian }}"
                readonly>
        </div>
        <div class="col-md-4">
            <label for="jenis">Jenis Pembayaran</label>
            <input type="text" id="jenis" class="form-control" value="{{ $pembelian_detail[0]->jenis_pembayaran }}"
                readonly>
        </div>
    </div>

    <div class="row mb-4 mt-3">
        <div class="col-md-4">
            <label for="nama">Nama Supplier</label>
            <input type="text" id="nama" class="form-control"
                value="{{ $pembelian_detail[0]->bahanbaku->supplier->nama }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="tempo">Tanggal Jatuh Tempo</label>
            <input type="text" id="tempo" class="form-control" value="{{ $kredit }}" readonly>
        </div>
        <div class="col-md-4">
            <label for="ket">Keterangan</label>
            <textarea type="text" rows="5" id="ket" class="form-control" readonly>{{ $pembelian_detail[0]->pembelian->keterangan }}</textarea>
        </div>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode Bahan Baku</th>
                            <th>Nama Bahan Baku </th>
                            <th>Jumlah </th>
                            <th>Harga </th>
                            <th>Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian_detail as $pd)
                            <tr align="center">
                                <td>{{ $pd->bahanbaku->nama_material }}</td>
                                <td>{{ $pd->bahanbaku->kode_material }}</td>
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
                                <td>@currency($pd->bahanbaku->harga * $pd->jumlah)</td>
                            </tr>
                        @endforeach
                        <tr align="center">
                            <td colspan="3"></td>
                            <td><b>Total</b></td>
                            <td><b>@currency($pembelian_detail[0]->pembelian->total)</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
