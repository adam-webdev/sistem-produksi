@extends('layouts.layout')
@section('title', 'Jadwal Produksi')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Jadwal Produksi </h1>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal Produksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jadwal-produksi.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode">Kode Jadwal Produksi :</label>
                            <input type="text" name="kode" class="form-control" id="kode" value="{{ $kodeGenerator }}"
                                readonly required>
                        </div>
                        <div class="form-group row align-items-center add-data">
                            <div class="col-md-6">
                                <label for="barang">Finish Good :</label>
                                <select style="width:100%" name="stokfinishgood_id[]" id="barang" class="form-control  "
                                    required>
                                    <option selected disabled value="">-- Pilih Finish Good --</option>
                                    @foreach ($stokfinishgoods as $sfg)
                                        <option value="{{ $sfg->id }}">{{ $sfg->finishgood->nama_fg }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="barang">Target Produksi :</label>
                                <input type="number" name="target[]" class="form-control" id="barang" required>
                            </div>

                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button id="add" name="add" type="button" class="btn btn-sm btn-success">Add</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barang">Tanggal :</label>
                            <input type="date" name="tanggal" class="form-control" id="barang" required>
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
                            <th>Kode Jadwal Produksi </th>
                            <th>Nama FG </th>
                            <th>Tanggal</th>
                            <th>Jenis Warna Barang </th>
                            <th>Target </th>
                            <th>Satuan </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $b)
                            <tr align="center">
                                <td>{{ $b->kode_jadwalproduksi }}</td>
                                <td>{{ $b->stokfinishgood->finishgood->nama_fg }}</td>
                                <td>{{ $b->tanggal }}</td>
                                <td>{{ $b->stokfinishgood->finishgood->jeniswarna_fg }}</td>
                                <td>{{ $b->jumlah_barang }}</td>
                                <td>{{ $b->stokfinishgood->satuan }}</td>
                                <td align="center" width="10%">
                                    @role('Admin')
                                        <a href="{{ route('jadwal-produksi.edit', [$b->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/jadwal-produksi/hapus/{{ $b->id }}" data-toggle="tooltip"
                                            title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select').select2({
                tags: true,
                width: 'resolve'
            });
            $('.select1').select2({
                tags: true,
                width: 'resolve'
            });
        });
        $(add).on('click', function() {
            $('.add-data').append(`<div class="form-group px-3 mt-2 row child              align-items-center">
                            <div class="col-md-6">
                                <label for="barang">Finish Good :</label>
                                <select style="width:100%" name="stokfinishgood_id[]" id="barang" class="form-control "
                                    required>
                                    <option selected disabled value="">-- Pilih Finish Good --</option>
                                    @foreach ($stokfinishgoods as $sfg)
                                        <option value="{{ $sfg->id }}">{{ $sfg->finishgood->nama_fg }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="barang">Target Produksi :</label>
                                <input type="number" name="target[]" class="form-control" id="barang" required>
                            </div>
                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button type="button" class="btn btn-sm  delete-child btn-danger">Delete</button>
                            </div>
                        </div>
                         `)
        })
        $(document).on('click', '.delete-child', function() {
            $(this).parents('.child').remove()
        })
    </script>
@endsection
