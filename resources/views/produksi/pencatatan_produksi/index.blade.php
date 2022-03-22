@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Hasil Produksi</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            + Tambah
        </button>
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
                <form action="{{ route('pencatatan-produksi.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="barang">Nama Material :</label>
                            <select style="width:100%" name="jadwalproduksi_id" id="barang" class="form-control select"
                                required>
                                @foreach ($data as $b)
                                    <option value="{{ $b->id }}">{{ $b->jadwalproduksi->nama_barang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Barang :</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah_barang">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan :</label>
                            <textarea type="text" name="keterangan" class="form-control" id="keterangan"></textarea>
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
                            <th>Nama Barang</th>
                            <th>Tanggal</th>
                            <th>Jenis Warna Barang</th>
                            <th>Target Yang Diharapkan</th>
                            <th>Target Yang Diselesaikan</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr align="center">
                                <td>{{ $data->jadwalproduksi->nama_barang }}</td>
                                <td>{{ $data->jadwalproduksi->tanggal->format('d-m-Y') }}</td>
                                <td>{{ $data->jadwalproduksi->jeniswarna_barang }}</td>
                                <td>{{ $data->jadwalproduksi->jumlah_barang }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->jumlah >= $data->jadwalproduksi->jumlah_barang ? 'Tercapai' : 'Belum Tercapai' }}
                                </td>
                                <td>{{ $data->keterangan }}</td>
                                <td align="center" width="10%">
                                    <a href="{{ route('pencatatan-produksi.edit', [$data->id]) }}" data-toggle="tooltip"
                                        title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                    </a>
                                    <a href="/pencatatan-produksi/hapus/{{ $data->id }}" data-toggle="tooltip"
                                        title="Hapus" onclick="return confirm('Yakin Ingin menghapus data?')"
                                        class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                        <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                    </a>
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
