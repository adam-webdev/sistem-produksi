@extends('layouts.layout')
@section('title', 'Edit Pembelian')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Pembelian </h1>
        <!-- Button trigger modal -->

    </div>

    <!-- Modal -->
    <div class="card p-4 col-md-6">
        <form action="{{ route('pembelian.update', [$pembelian_id->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="kode_barang">No Pembelian :</label>
                    <input type="text" name="no_pembelian" value="{{ $pembelian_id->no_pembelian }}" class="form-control"
                        id="kode_barang" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="tanggal">Tanggal Pembelian :</label>
                    <input type="date" name="tanggal_pembelian" class="form-control"
                        value={{ $pembelian_id->tanggal_pembelian }} id="tanggal" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">

                    <label for="bahanbaku">Supplier :</label>
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <select type="text" name="supplier" class="form-control " id="bahanbaku" required>
                        <option value="{{ $pembelian_id->pembeliandetail[0]->bahanbaku->supplier->id }}" selected
                            disabled>
                            {{ $pembelian_id->pembeliandetail[0]->bahanbaku->supplier->nama }}</option>
                        @foreach ($supplier as $sp)
                            <option value="{{ $sp->id }}">{{ $sp->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group add-data" id="ajax">

            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="satuan">Jenis Pembayaran :</label>
                    <select style="width:100%" name="jenis_pembayaran" id="satuan" class="form-control" required>
                        {{-- <option disabled value="{{ $pembeliandetail_id[0]->jenis_pembayaran }}">
                            {{ $pembeliandetail_id[0]->jenis_pembayaran }}</option> --}}
                        <option value="Cash" {{ $pembeliandetail_id[0]->jenis_pembayaran === 'Cash' ? 'selected' : '' }}>
                            Cash</option>
                        <option value="Kredit"
                            {{ $pembeliandetail_id[0]->jenis_pembayaran === 'Kredit' ? 'selected' : '' }}>Kredit</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="ket">Keterangan :</label>
                    <textarea name="keterangan" id="ket" rows="4" class="form-control">{{ $pembelian_id->keterangan }}</textarea>
                </div>
            </div>

            <input type="submit" class="btn btn-primary btn-send" value="Simpan">
        </form>
    </div>




    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
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
                                        <a href="{{ route('pembelian.edit', [$pb->id]) }}" data-toggle="tooltip" title="Edit"
                                            class="d-none  d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
                                            <i class="fas fa-edit fa-sm text-white-50"></i>
                                        </a>
                                        <a href="/pembelian/hapus/{{ $pb->id }}" data-toggle="tooltip" title="Hapus"
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
    </div> --}}
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

                              <div class="col-md-12 row">
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
                                    <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                                </div>

                                <div class="col-md-2 add">
                                    <label>Aksi :</label>
                                    <button id="add" name="add" type="button" class="btn btn-sm btn-success">Add</button>
                                </div>
                              </div>
                        `)
                        $(document).ready(function() {

                            $(add).on('click', function() {
                                $('.add-data').append(`
                                <div class="col-md-12 child row">
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
                                      <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                                  </div>
                                  <div class="col-md-2 add">
                                      <label>Aksi :</label>
                                      <button id="add" name="add" type="button" class="btn btn-sm btn-danger delete-child btn-danger">Delete</button>
                                  </div>
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
