@extends('layouts.layout')
@section('title', 'Bahan Baku Masuk')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
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
                            <label for="nopembelian">No Pembelian :</label>
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <select style="width:100%" name="pembelian_id" id="nopembelian" class="form-control select"
                                required>
                                <option value="">-- Pilih No Pembelian --</option>
                                @foreach ($pembelian as $pb)
                                    <option value="{{ $pb->id }}">{{ $pb->no_pembelian }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row add-data" id="ajax">


                        </div>

                        {{-- <div class="form-group">
                            <label for="jumlah_barang">Jumlah Material :</label>
                            <input type="number" name="jumlah" class="form-control" id="jumlah_barang" required>
                        </div>
                        <div class="form-group">
                            <label for="date">Tanggal :</label>
                            <input type="date" name="tanggal" class="form-control" id="date" required>
                        </div> --}}


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
                                <td>{{ $bm->bahanbaku->kode_material }}</td>
                                <td>{{ $bm->tanggal }}</td>
                                <td>{{ $bm->bahanbaku->nama_material }}</td>
                                <td>{{ $bm->jumlah }}</td>
                                <td>{{ $bm->bahanbaku->satuan }}</td>
                                {{-- <td>{{ $bm->stok->jumlah_material }}</td> --}}
                                <td align="center" width="10%">
                                    {{-- <a href="{{ route('bahanbaku-masuk.edit', [$bm->id]) }}" data-toggle="tooltip"
                                        title="Edit" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                        <i class="fas fa-edit fa-sm text-white-50"></i>
                                    </a> --}}
                                    @role('Admin|Gudang')
                                        <a href="/bahanbaku-masuk/hapus/{{ $bm->id }}" data-toggle="tooltip"
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
        // $(document).ready(function() {
        //     $('.select').select2({
        //         tags: true,
        //         width: 'resolve'
        //     });
        // });
        $(document).ready(function() {

            var data = []
            $('#nopembelian').on('change', function() {
                var pembelian_id = $(this).val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('bahanbaku-masuk.detail') }}",
                    data: {
                        // _token: "{{ csrf_token() }}",
                        pembelian_id: pembelian_id
                    },
                    success: function(data) {
                        console.log(data)
                        $('#ajax').html(`
                                ${
                                    data.map((dd) => {
                                    return `<div class="col-md-5">
                                                        <label for="bahanbaku">Bahan Baku :</label>
                                                        <select type="text" name="bahanbaku_id[]" class="form-control" id="bahanbaku"
                                                            required>
                                                            <option value="${dd.bahanbaku_id}">${dd.bahanbaku.nama_material}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label for="jumlah">Jumlah :</label>
                                                            <input type="number" value="${dd.jumlah}" min="1" name="jumlah[]" class="form-control" id="jumlah" required>
                                                        </div>

                                                        `
                                    })

                                }




                         `)

                    }
                })

            })
            // $('#bahanbaku').on('change', function() {
            //     $(this).parents('.add-data').remove()
            // })

        })
    </script>
@endsection
{{-- ${
    dd.map((pd) => {
        return `<option value="${pd.bahanbaku_id}">${pd.bahanbaku.nama_material}</option>`
    })
} --}}
{{-- <div class="col-md-2 add">
    <label>Aksi :</label>
    <button id="add" name="add" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></button>
</div> --}}
