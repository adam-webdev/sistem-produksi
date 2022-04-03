@extends('layouts.layout')
@section('title', 'Bahan Baku Masuk')

@section('content')
    @include('sweetalert::alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Material Masuk</h1>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('bahanbaku-masuk.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="barang">Nama Material :</label>
                            <select style="width:100%" name="stok_id" id="barang" class="form-control select" required>
                                <option selected disabled value="">-- Pilih Bahan Baku --</option>
                                @foreach ($stok as $b)
                                    <option value="{{ $b->id }}">{{ $b->bahanbaku->nama_material }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_barang">Jumlah Material :</label>
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
                            <th>Kode Material</th>
                            <th>Tanggal</th>
                            <th>Nama Material</th>
                            <th>Material Baru</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bahanbaku_masuk as $bm)
                            <tr align="center">
                                <td>{{ $bm->stok->bahanbaku->kode_material }}</td>
                                <td>{{ $bm->created_at->format('d-m-Y') }}</td>
                                <td>{{ $bm->stok->bahanbaku->nama_material }}</td>
                                <td>{{ $bm->jumlah }}</td>
                                <td>{{ $bm->stok->satuan }}</td>
                                {{-- <td>{{ $bm->stok->jumlah_material }}</td> --}}
                                <td align="center" width="10%">
                                    {{-- <a href="{{ route('bahanbaku-masuk.edit', [$bm->id]) }}" data-toggle="tooltip"
                                        title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                    </a> --}}
                                    @role('Admin|Gudang')
                                        <a href="/bahanbaku-masuk/hapus/{{ $bm->id }}" data-toggle="tooltip" title="Hapus"
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
