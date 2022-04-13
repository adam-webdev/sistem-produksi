@extends('layouts.layout')
@section('title', 'Penjualan')

@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Penjualan </h1>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penjualan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('penjualan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="kode_barang">No Penjualan :</label>
                                <input type="text" name="no_penjualan" value="{{ $no }}" class="form-control"
                                    id="kode_barang" readonly required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal">Tanggal Penjualan :</label>
                                <input type="date" name="tanggal_penjualan" class="form-control" id="tanggal" required>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="customer_id">Customer :</label>
                            <select type="text" name="customer_id" class="form-control" id="customer_id" required>
                                <option value="">-- Pilih Nama Customer --</option>
                                @foreach ($customer as $c)
                                    <option value="{{ $c->id }}">{{ $c->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row add-data">
                            <div class="col-md-5">
                                <label for="finishgood_id">Nama Finish Good :</label>
                                <select type="text" name="finishgood_id[]" class="form-control" id="finishgood_id"
                                    required>
                                    <option value="">-- Pilih Nama Finish Good --</option>
                                    @foreach ($finishgood as $fg)
                                        <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="jumlah">Jumlah :</label>
                                <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                            </div>

                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button id="add" name="add" type="button" class="btn btn-sm btn-success">Add</button>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="satuan">Jenis Pembayaran :</label>
                            <select style="width:100%" name="jenis_pembayaran" id="satuan" class="form-control" required>
                                <option selected disabled value="">-- Pilih Jenis Pembayaran --</option>
                                <option value="Cash">Cash</option>
                                <option value="Kredit">Kredit</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ket">Keterangan :</label>
                            <textarea name="keterangan" id="ket" rows="4" class="form-control"></textarea>
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
                            <th>No Penjualan</th>
                            <th>Customer </th>
                            <th>Tanggal Penjualan </th>
                            <th>Keterangan </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan as $pj)
                            <tr align="center">
                                <td>{{ $pj->no_penjualan }}</td>
                                <td>{{ $pj->penjualandetail[0]->customer->nama_customer }}</td>
                                <td>{{ $pj->tanggal_penjualan }}</td>
                                <td>{{ $pj->keterangan }}</td>
                                <td align="center" width="15%">
                                    @role('Admin')
                                        <a href="{{ route('penjualan.detail', [$pj->id]) }}" data-toggle="tooltip"
                                            title="Detail" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-eye  text-white-50"></i>
                                        </a>
                                        {{-- <a href="{{ route('penjualan.edit', [$pj->id]) }}" data-toggle="tooltip" title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a> --}}
                                        <a href="/penjualan/hapus/{{ $pj->id }}" data-toggle="tooltip" title="Hapus"
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
{{-- @foreach ($bahanbaku as $bb)
// <option value="{{ $bb->id }}">{{ $bb->nama_material }}</option>
//
@endforeach --}}
@section('scripts')

    <script>
        $(document).ready(function() {

            $(add).on('click', function() {
                $('.add-data').append(` <div class="form-group row child px-3 mt-3">
                    <div class="col-md-5">
                        <label for="finishgood">Nama Finish Good :</label>
                        <select type="text" name="finishgood_id[]" class="form-control" id="finishgood" required>
                            <option value="">-- Pilih Nama Finish Good --</option>
                                    @foreach ($finishgood as $fg)
                                        <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                                    @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="jumlah">Jumlah :</label>
                        <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                    </div>
                    <div class="col-md-2 add">
                        <label>Aksi :</label>
                        <button id="add" name="add" type="button" class="btn btn-sm btn-danger delete-child btn-danger">Delete</button>
                    </div>
                    </div>`)
            })

            $(document).on('click', '.delete-child', function() {
                $(this).parents('.child').remove()
            })

        })
    </script>
@endsection
