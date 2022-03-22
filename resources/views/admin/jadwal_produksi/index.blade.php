@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Jadwal Produksi </h1>
        <!-- Button trigger modal -->
        {{-- @role('admin') --}}
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            + Tambah
        </button>
        {{-- @endrole --}}

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal Produksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jadwal-produksi.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Barang :</label>
                            <input type="text" name="nama_barang" class="form-control id=" nama">
                        </div>

                        <div class="form-group">
                            <label for="barang">Tanggal </label>
                            <input type="date" name="tanggal" class="form-control" id="barang">
                        </div>
                        <div class="form-group">
                            <label for="barang">Target Produksi</label>
                            <input type="number" name="target" class="form-control" id="barang">
                        </div>

                        <div class="form-group">
                            <label for="jenis_warna">Jenis Warna Material :</label>
                            <select type="text" name="jenis" class="form-control" id="jenis_warna">
                                <option disabled selected>-- Pilih Jenis Warna --</option>
                                <option value="Tidak ada">Tidak ada</option>
                                <option value="Red">Red</option>
                                <option value="White">White</option>
                                <option value="Black">Black</option>
                                <option value="Green">Green</option>
                                <option value="Yellow">Yellow</option>
                                <option value="Gold">Gold</option>
                                <option value="Blue">Blue</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                    </div>
            </div>
            </form>


        </div>
    </div>



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-str6iped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Nama Barang </th>
                            <th>Tanggal</th>
                            <th>Jenis Warna Barang </th>
                            <th>Target </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $b)
                            <tr align="center">
                                <td>{{ $b->nama_barang }}</td>
                                <td>{{ $b->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $b->jeniswarna_barang }}</td>
                                <td>{{ $b->jumlah_barang }}</td>
                                <td align="center" width="10%">
                                    {{-- @role('admin') --}}
                                    <a href="{{ route('jadwal-produksi.edit', [$b->id]) }}" data-toggle="tooltip"
                                        title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                    </a>
                                    <a href="/jadwal-produksi/hapus/{{ $b->id }}" data-toggle="tooltip" title="Hapus"
                                        onclick="return confirm('Yakin Ingin menghapus data?')"
                                        class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                        <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                    </a>
                                    {{-- @endrole --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
