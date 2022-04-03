@extends('layouts.layout')
@section('title', 'Stok Finish Good')
@section('content')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Stok Finish Good</h1>
        <!-- Button trigger modal -->
        @role('Admin|Gudang')
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Stok FG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('stokfinishgood.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="barang">Nama Finish Good :</label>
                            <select style="width:100%" name="finishgood_id" id="barang" class="form-control select"
                                required>
                                <option selected disabled value="">-- Pilih Data --</option>
                                @foreach ($finishgoods as $b)
                                    <option value="{{ $b->id }}">{{ $b->nama_fg }}</option>
                                @endforeach
                            </select>
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
                            <label for="jumlah_barang">Jumlah :</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah_barang" required>
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
                            <th>Kode FG</th>
                            <th>Tanggal</th>
                            <th>Nama Finish Good</th>
                            <th>Jenis Warna FG</th>
                            <th>Jumlah Stok FG</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stokfinishgood as $fg)
                            <tr align="center">
                                <td>{{ $fg->finishgood->kode_fg }}</td>
                                <td>{{ $fg->created_at->format('d-m-Y') }}</td>
                                <td>{{ $fg->finishgood->nama_fg }}</td>
                                <td>{{ $fg->finishgood->jeniswarna_fg }}</td>
                                <td>{{ $fg->jumlah }}</td>
                                <td>{{ $fg->satuan }}</td>
                                <td align="center" width="10%">
                                    @role('Admin|Gudang')
                                        <a href="{{ route('stokfinishgood.edit', [$fg->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/stokfinishgood/hapus/{{ $fg->id }}" data-toggle="tooltip" title="Hapus"
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
