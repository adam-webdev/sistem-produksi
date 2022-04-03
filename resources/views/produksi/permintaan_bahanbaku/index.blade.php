@extends('layouts.layout')
@section('title', 'Permintaan Bahan Baku')
@section('content')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Permintaan Bahan Baku</h1>
        <!-- Button trigger modal -->
        @role('Admin|Produksi')
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('permintaan-bahanbaku.store') }}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group">
                            <label for="kode">Kode :</label>
                            <input type="text" name="kode" class="form-control" id="kode" value="{{ $kodeGenerator }}"
                                readonly required>
                        </div>

                        <div class="form-group row align-items-center add-data">
                            <div class="col-md-5">
                                <label for="barang">Nama Material :</label>
                                <select style="width:100%" name="bahanbaku_id[]" id="barang" class="form-control "
                                    required>
                                    <option selected disabled value="">-- pilih material --</option>
                                    @foreach ($bahanbaku as $b)
                                        <option value="{{ $b->id }}">{{ $b->nama_material }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="jumlah_barang">Jumlah Material :</label>
                                <input type="number" name="jumlah_material[]" class="form-control" id="jumlah_barang"
                                    required>
                            </div>
                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button id="add" name="add" type="button" class="btn btn-sm btn-success">Add</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal :</label>
                            <input type="date" name="date" class="form-control" id="tanggal" required>
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
    {{-- modal tambah dokter --}}



    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode Permintaan</th>
                            <th>Tanggal</th>
                            <th>Nama Material</th>
                            <th>Jumlah Material</th>
                            {{-- <th>Satuan</th> --}}
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr align="center">
                                <td>{{ $data->kode }}</td>
                                <td>{{ $data->date }}</td>
                                <td>{{ $data->bahanbaku->nama_material }}</td>
                                <td>{{ $data->jumlah_material }}</td>
                                {{-- <td>{{ $data->bahanbaku->stok->satuan }}</td> --}}
                                @if ($data->status === 'Permintaan Diterima')
                                    <td><span class="btn btn-sm btn-light shadow-md text-success">Permintaan Diterima</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="btn btn-sm btn-light text-danger shadow-lg">Belum Diterima</span>
                                    </td>
                                @endif

                                <td align="center" width="10%">
                                    @role('Admin|Produksi')
                                        <a href="{{ route('permintaan-bahanbaku.edit', [$data->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/permintaan-bahanbaku/hapus/{{ $data->id }}" data-toggle="tooltip"
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
        });
        $(add).on('click', function() {
            $('.add-data').append(`<div class="form-group row child mt-2 px-3 align-items-center">
                            <div class="col-md-5">
                                <label for="barang">Nama Material :</label>
                                <select style="width:100%" name="bahanbaku_id[]" id="barang" class="form-control "
                                    required>
                                    <option selected disabled value="">-- pilih material --</option>
                                    @foreach ($bahanbaku as $b)
                                        <option value="{{ $b->id }}">{{ $b->nama_material }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="jumlah_barang">Jumlah Material :</label>
                                <input type="number" name="jumlah_material[]" class="form-control" id="jumlah_barang"
                                    required>
                            </div>
                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button type="button"  class="btn btn-sm  delete-child btn-danger">Delete</button>
                            </div>
                        </div>`)
        })
        $(document).on('click', '.delete-child', function() {
            $(this).parents('.child').remove()
        })
    </script>
@endsection
