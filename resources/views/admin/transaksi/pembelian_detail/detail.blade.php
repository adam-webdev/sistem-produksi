@extends('layouts.layout')
@section('title', 'Detail Pembelian')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembelian </h1>
        <!-- Button trigger modal -->
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>No Pembelian</th>
                            <th>Nama Bahan Baku </th>
                            <th>Jenis Pembayaran </th>
                            <th>Harga </th>
                            <th>Jumlah </th>
                            <th>Tanggal Pembayaran </th>
                            <th>Tanggal Jatuh Tempo </th>
                            <th>Total </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian_detail as $pd)
                            <tr align="center">
                                <td>{{ $pd->pembelian->no_pembelian }}</td>
                                <td>{{ $pd->bahanbaku->nama_material }}</td>
                                <td>{{ $pd->jenis_pembayaran }}</td>
                                <td>@currency($pd->bahanbaku->harga) </td>
                                <td>{{ $pd->jumlah }}</td>
                                @if ($pd->jenis_pembayaran === 'Cash')
                                    <td>{{ $pd->tanggal_pembayaran }}</td>
                                @else
                                    <td> - </td>
                                @endif

                                @if ($pd->jenis_pembayaran === 'Kredit')
                                    <td>{{ $pd->tanggal_pembayaran }}</td>
                                @else
                                    <td>-</td>
                                @endif
                                <td>@currency($pd->bahanbaku->harga * $pd->jumlah)</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
