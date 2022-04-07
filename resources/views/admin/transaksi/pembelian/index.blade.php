@extends('layouts.layout')
@section('title', 'Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Belanja </h1>
        <!-- Button trigger modal -->

    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode Material</th>
                            <th>Nama Material </th>
                            <th>Jenis Material </th>
                            <th>Jumlah Material </th>
                            <th>Satuan Material </th>
                            <th>Supplier </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bahanbaku as $b)
                            <tr align="center">
                                <td>{{ $b->kode_material }}</td>
                                <td>{{ $b->nama_material }}</td>
                                <td>{{ $b->jenis_material }}</td>
                                <td>{{ $b->jumlah_material }}</td>
                                <td>{{ $b->satuan }}</td>
                                <td>{{ $b->supplier->nama }}</td>
                                <td align="center" width="10%">
                                    @role('Admin')
                                        <a href="{{ route('pembelian.detail', [$b->id]) }}" data-toggle="tooltip"
                                            title="Detail" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
