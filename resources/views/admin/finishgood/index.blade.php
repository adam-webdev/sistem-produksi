@extends('layouts.layout')
@section('title', 'Finish Good')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Finish Good </h1>
        <!-- Button trigger modal -->
        @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole

    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Finish Good</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('finish-good.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode_barang">Kode Finish Good :</label>
                            <input type="text" name="kode_fg" class="form-control" id="kode_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="barang">Nama Finish Good :</label>
                            <input type="text" name="nama_fg" class="form-control" id="barang" required>
                        </div>

                        <div class="form-group">
                            <label for="jumlah">Jumlah Finish Good :</label>
                            <input type="text" name="jumlah_fg" class="form-control" id="jumlah" required>
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga Finish Good :</label>
                            <input type="text" name="harga" class="form-control" id="harga" required>
                        </div>

                        <div class="form-group">
                            <label for="satuan">Satuan Barang :</label>
                            <select style="width:100%" name="satuan_fg" id="satuan" class="form-control" required>
                                <option selected disabled value="">-- Pilih Satuan Finish Good --</option>
                                <option value="Unit">Unit</option>
                                <option value="Kg">Kg</option>
                                <option value="Liter">Liter</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Meter">Meter</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis_material">Jenis Warna Finish Good :</label>
                            <select type="number" name="jeniswarna_fg" class="form-control" id="jenis_material" required>
                                <option disabled selected value="">-- pilih jenis warna --</option>
                                <option value="Red">Red</option>
                                <option value="White">White</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                                <option value="Black">Black</option>
                                <option value="Gold">Gold</option>
                                <option value="Yellow">Yellow</option>
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
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode Finish Good</th>
                            <th>Nama Finish Good </th>
                            <th>Jumlah Finish Good </th>
                            <th>Satuan Finish Good </th>
                            <th>Harga </th>
                            <th>Jenis Warna Finish Good </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $b)
                            <tr align="center">
                                <td>{{ $b->kode_fg }}</td>
                                <td>{{ $b->nama_fg }}</td>
                                <td>{{ $b->jumlah_fg }}</td>
                                <td>{{ $b->satuan_fg }}</td>
                                <td>@currency($b->harga)</td>
                                <td>{{ $b->jeniswarna_fg }}</td>
                                <td align="center" width="10%">
                                    @role('Admin')
                                        <a href="{{ route('finish-good.edit', [$b->id]) }}" data-toggle="tooltip" title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/finish-good/hapus/{{ $b->id }}" data-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Yakin Ingin menghapus data?')"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i>
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
