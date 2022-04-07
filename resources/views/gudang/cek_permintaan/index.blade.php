@extends('layouts.layout')
@section('title', 'Cek Permintaan')
@section('content')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Permintaan Bahan Baku Produksi</h1>
    </div>
    <!-- Button trigger modal -->
    <p>Filter :</p>
    <form action="{{ route('cek-permintaan.filter') }}" method="post">
        @csrf
        <div class="form-group d-flex align-items-center">
            <div class="col-md-3">
                <label for="tanggal">Dari Tanggal :</label>
                <input type="date" class="form-control" name="from_tanggal" id="tanggal">
            </div>
            <div class="col-md-3">
                <label for="tanggal2">Sampai Tanggal :</label>
                <input type="date" class="form-control" name="to_tanggal" id="tanggal2">
            </div>
            <div class="col-md-3">
                <button type="submit" class=" mt-4 btn btn-sm btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode Material</th>
                            <th>Tanggal</th>
                            <th>Nama Material</th>
                            <th>Jumlah Material</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dataFilter !== 0)
                            @foreach ($dataFilter as $data)
                                <tr align="center">
                                    <td>{{ $data->bahanbaku->kode_material }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->bahanbaku->nama_material }}</td>
                                    <td>{{ $data->jumlah_material }}</td>
                                    @if ($data->status === 'Permintaan Diterima')
                                        <td><span class="btn btn-sm btn-light  shadow-sm text-primary">Permintaan
                                                Diterima</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="btn btn-sm btn-light shadow-sm text-danger">Belum Diterima</span>
                                        </td>
                                    @endif
                                    <td align="center" width="10%">
                                        <a href="{{ route('cek-permintaan.edit', [$data->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            @foreach ($data as $data)
                                <tr align="center">
                                    <td>{{ $data->bahanbaku->kode_material }}</td>
                                    <td>{{ $data->tanggal }}</td>
                                    <td>{{ $data->bahanbaku->nama_material }}</td>
                                    <td>{{ $data->jumlah_material }}</td>
                                    @if ($data->status === 'Permintaan Diterima')
                                        <td><span class="btn btn-sm btn-light  shadow-sm text-primary">Permintaan
                                                Diterima</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class="btn btn-sm btn-light shadow-sm text-danger">Belum Diterima</span>
                                        </td>
                                    @endif
                                    <td align="center" width="10%">
                                        <a href="{{ route('cek-permintaan.edit', [$data->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
