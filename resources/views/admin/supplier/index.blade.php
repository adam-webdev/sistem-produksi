@extends('layouts.layout')
@section('title', 'Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Supplier </h1>
        <!-- Button trigger modal -->
        @role('Admin')
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                + Tambah
            </button>
        @endrole

    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('supplier.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Supplier :</label>
                            <input type="text" name="nama" class="form-control id=" nama" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="text" name="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="nohp">No HP :</label>
                            <input type="number" name="nohp" class="form-control" id="nohp" required>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Bank :</label>
                            <select name="nama_bank" id="nama" class="form-control">
                                <option value=" BRI"> Bank BRI</option>
                                <option value="Mandiri">Bank Mandiri</option>
                                <option value="BCA">Bank BCA</option>
                                <option value="BTN">Bank BTN</option>
                                <option value="Permata">Bank Permata</option>
                                <option value="Syariah">Bank Syariah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rekening">No Rekening :</label>
                            <input type="number" name="no_rekening" class="form-control" id="rekening" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat :</label>
                            <textarea type="text" rows="4" name="alamat" class="form-control" id="nohp" required>
                            </textarea>
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
                            <th>Nama Supplier</th>
                            <th>Contact </th>
                            <th>Email </th>
                            <th>Alamat </th>
                            <th>Nama Bank </th>
                            <th>No Rekening </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $s)
                            <tr align="center">
                                <td>{{ $s->nama }}</td>
                                <td>{{ $s->nohp }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->alamat }}</td>
                                <td>{{ $s->nama_bank }}</td>
                                <td>{{ $s->no_rekening }}</td>
                                <td align="center" width="10%">
                                    @role('Admin')
                                        <a href="{{ route('supplier.edit', [$s->id]) }}" data-toggle="tooltip" title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/supplier/hapus/{{ $s->id }}" data-toggle="tooltip" title="Hapus"
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
