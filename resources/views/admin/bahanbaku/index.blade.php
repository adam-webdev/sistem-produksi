@extends('layouts.layout')
@section('title', 'Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Material </h1>
        <!-- Button trigger modal -->
        @role('Admin')
            <div type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-shopping-basket"></i>
                Buy
            </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Material</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bahan-baku.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="kode_barang">Kode Material :</label>
                                <input type="text" name="kode_material" class="form-control id=" kode_barang" required>
                            </div>
                            <div class="col-md-6">
                                <label for="barang">Nama Material :</label>
                                <input type="text" name="nama_material" class="form-control" id="barang" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="harga">Harga :</label>
                                <input type="number" name="harga" class="form-control" id="harga" required>
                            </div>
                            <div class="col-md-6">
                                <label for="jumlah">Jumlah Material :</label>
                                <input type="number" name="jumlah_material" class="form-control" id="jumlah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan Barang :</label>
                            <select style="width:100%" name="satuan" id="satuan" class="form-control" required>
                                <option selected disabled value="">-- Pilih Satuan Barang --</option>
                                <option value="Unit">Unit</option>
                                <option value="Kg">Kg</option>
                                <option value="Liter">Liter</option>
                                <option value="Pcs">Pcs</option>
                                <option value="Meter">Meter</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis_material">Jenis Material :</label>
                            <select type="text" required name="jenis_material" class="form-control" id="jenis_material">
                                <option disabled selected value="">-- Pilih Jenis Material --</option>
                                <option value="a">a</option>
                                <option value="b">b</option>
                                <option value="c">c</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="supplier">Supplier :</label>
                            <select type="text" name="supplier_id" class="form-control" id="supplier" required>
                                @foreach ($supplier as $s)
                                    <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                @endforeach
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
                                        <a href="{{ route('bahan-baku.edit', [$b->id]) }}" data-toggle="tooltip" title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/bahan-baku/hapus/{{ $b->id }}" data-toggle="tooltip" title="Hapus"
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
