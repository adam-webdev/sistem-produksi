@extends('layouts.layout')
@section('title', 'Hasil Produksi')
@section('content')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 flex-grow-1">Data Hasil Produksi</h1>
        <!-- Button trigger modal -->
        <a href="{{ route('cek-jadwalproduksi.index') }}" class="btn btn-success mr-2">
            Cek Jadwal Produksi
        </a>
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


                <form action="{{ route('pencatatan-produksi.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="barang">Kode Jadwal Produksi :</label>
                            <select style="width:100%" name="jadwalproduksi_id" id="barang" class="form-control select"
                                required>
                                <option selected disabled value="">-- Pilih Kode Jadwal Produksi --</option>
                                @foreach ($jadwalproduksi as $b)
                                    <option value="{{ $b->id }}">
                                        {{ $b->kode_jadwalproduksi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="barang">Nama Stok FG :</label>
                            <select style="width:100%" name="finishgood_id" id="barang" class="form-control select"
                                required>
                                <option selected disabled value="">-- Pilih Stok Finish Good --</option>
                                @foreach ($finishgood as $fg)
                                    <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Barang :</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan :</label>
                            <textarea type="text" name="keterangan" class="form-control" id="keterangan" required></textarea>
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
                <table style="overflow-x: scroll!important;" class="table table-striped table-bordered" id="dataTable"
                    width="100%" cellspacing="0">
                    <thead>
                        <tr align="center">
                            <th>Kode FG</th>
                            <th>Nama FG</th>
                            <th>Tanggal</th>
                            <th>Jenis Warna FG</th>
                            <th>Target Yang Diharapkan</th>
                            <th>Target Yang Diselesaikan</th>
                            <th>Satuan</th>
                            <th>Status</th>
                            <th width="100px">Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $data)
                            <tr align="center">
                                <td>{{ $data->finishgood->kode_fg }}</td>
                                <td>{{ $data->finishgood->nama_fg }}</td>
                                <td>{{ $data->jadwalproduksi->tanggal }}</td>
                                <td>{{ $data->finishgood->jeniswarna_fg }}</td>
                                <td>{{ $data->jadwalproduksi->jumlah_barang }}</td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->finishgood->satuan }}</td>
                                @if ($data->jumlah >= $data->jadwalproduksi->jumlah_barang)
                                    <td><span class="btn btn-sm btn-light text-success shadow-sm">Tercapai</span></td>
                                @else
                                    <td width="150px">
                                        <span class="btn btn-sm btn-light text-danger shadow-sm">Belum Tercapai</span>
                                    </td>
                                @endif
                                <td style="width:100px;">{{ $data->keterangan }}</td>
                                <td align="center" width="10%">
                                    @role('Admin|Produksi')
                                        <a href="{{ route('pencatatan-produksi.edit', [$data->id]) }}" data-toggle="tooltip"
                                            title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/pencatatan-produksi/hapus/{{ $data->id }}" data-toggle="tooltip"
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
    </script>
@endsection
