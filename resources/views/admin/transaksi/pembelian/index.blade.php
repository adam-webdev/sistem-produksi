@extends('layouts.layout')
@section('title', 'Pembelian')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Pembelian </h1>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pembelian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pembelian.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="kode_barang">No Pembelian :</label>
                                <input type="text" name="no_pembelian" value="{{ $no }}" class="form-control"
                                    id="kode_barang" readonly required>
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal">Tanggal Pembelian :</label>
                                <input type="date" name="tanggal_pembelian" class="form-control" id="tanggal" required>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="bahanbaku">Supplier :</label>
                            <input type="hidden" id="_token" value="{{ csrf_token() }}">
                            <select type="text" name="supplier" class="form-control " id="bahanbaku" required>
                                <option value="" selected disabled>-- Pilih Supplier --</option>
                                @foreach ($supplier as $sp)
                                    <option value="{{ $sp->id }}">{{ $sp->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row add-data" id="ajax">



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
                            <th>No Pembelian</th>
                            <th>Tanggal Pembelian </th>
                            <th>Keterangan </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $pb)
                            <tr align="center">
                                <td>{{ $pb->no_pembelian }}</td>
                                <td>{{ $pb->tanggal_pembelian }}</td>
                                <td>{{ $pb->keterangan }}</td>
                                <td align="center" width="15%">
                                    @role('Admin')
                                        <a href="{{ route('pembelian.detail', [$pb->id]) }}" data-toggle="tooltip"
                                            title="Detail" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                                            <i class="fas fa-eye  text-white-50"></i>
                                        </a>
                                        <a href="{{ route('pembelian.edit', [$pb->id]) }}" data-toggle="tooltip"
                                            title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        {{-- <a href="/pembelian/hapus/{{ $pb->id }}" data-toggle="tooltip" title="Hapus"
                                            onclick="return confirm('Yakin Ingin menghapus data?')"
                                            class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm">
                                            <i class="fas fa-trash-alt fa-sm text-white-50"></i>
                                        </a> --}}
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
            var data = []
            $('#bahanbaku').on('change', function() {
                var supp_id = $(this).val()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('pembelian.bahanbakuid') }}",
                    data: {
                        // _token: "{{ csrf_token() }}",
                        supp_id: supp_id
                    },
                    success: function(data) {
                        console.log(data)
                        $('#ajax').html(`
                                <div class="col-md-5">
                                    <label for="bahanbaku">Bahan Baku :</label>
                                    <select type="text" name="bahanbaku_id[]" class="form-control" id="bahanbaku"
                                        required>
                                        ${
                                            data.map((bb) => {
                                                return `<option value="${bb.id}">${bb.nama_material}</option>`
                                            })
                                        }

                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="jumlah">Jumlah :</label>
                                    <input type="number" min="1" name="jumlah[]" class="form-control" id="jumlah" required>
                                </div>

                                <div class="col-md-2 add">
                                    <label>Aksi :</label>
                                    <button id="add" name="add" type="button" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></button>
                                </div>
                        `)
                        $(document).ready(function() {

                            $(add).on('click', function() {
                                $('.add-data').append(` <div class="form-group row child px-3 mt-3">
                            <div class="col-md-5">
                                <label for="bahanbaku">Bahan Baku :</label>
                                <select type="text" name="bahanbaku_id[]" class="form-control" id="bahanbaku" required>
                                    ${
                                            data.map((bb) => {
                                                return `<option value="${bb.id}">${bb.nama_material}</option>`
                                            })
                                        }
                                </select>
                            </div>
                            <div class="col-md-5">
                                <label for="jumlah">Jumlah :</label>
                                <input type="number" name="jumlah[]" min="1" class="form-control" id="jumlah" required>
                            </div>
                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button id="add" name="add" type="button" class="btn btn-sm btn-danger delete-child btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>`)
                            })
                        })

                        $(document).on('click', '.delete-child', function() {
                            $(this).parents('.child').remove()
                        })
                    }
                })

            })
            // $('#bahanbaku').on('change', function() {
            //     $(this).parents('.add-data').remove()
            // })

        })
    </script>
@endsection
