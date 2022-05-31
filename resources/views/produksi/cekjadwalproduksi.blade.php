@extends('layouts.layout')
@section('title', 'Cek Jadwal Produksi')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Jadwal Produksi </h1>
        <!-- Button trigger modal -->

    </div>





    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-str6iped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode FG </th>
                            <th>Kode Jadwal </th>
                            <th>Nama FG </th>
                            <th>Tanggal</th>
                            <th>Jenis Warna Barang </th>
                            <th>Target </th>
                            <th>Satuan </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $b)
                            <tr align="center">
                                <td>{{ $b->finishgood->kode_fg }}</td>
                                <td>{{ $b->kode_jadwalproduksi }}</td>
                                <td>{{ $b->finishgood->nama_fg }}</td>
                                <td>{{ $b->tanggal }}</td>
                                <td>{{ $b->finishgood->jeniswarna_fg }}</td>
                                <td>{{ $b->jumlah_barang }}</td>
                                <td>{{ $b->finishgood->satuan_fg }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select').select2({
                tags: true,
                width: 'resolve'
            });
        });
    </script>
@endsection
