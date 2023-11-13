@extends('layouts.layout')
@section('title', 'Edit Penjualan')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Penjualan </h1>
        <!-- Button trigger modal -->

    </div>

    <!-- Modal -->
    <div class="card p-4 col-md-6 text-black">
        <form action="{{ route('penjualan.update', [$penjualan->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="_method" value="PUT">
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="kode_barang">No Penjualan :</label>
                    <input type="text" name="no_penjualan" value="{{ $penjualan->no_penjualan }}" class="form-control"
                        id="kode_barang" readonly>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="tanggal">Tanggal Penjualan :</label>
                    <input type="date" name="tanggal_penjualan" class="form-control"
                        value={{ $penjualan->tanggal_penjualan }} id="tanggal" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="customer">Customer :</label>
                    <input type="hidden" id="_token" value="{{ csrf_token() }}">
                    <select type="text" name="customer_id" class="form-control" id="customer" required>
                        {{-- <option value="{{ $penjualan->penjualandetail[0]->customer_id }}"  disabled>
                            {{ $penjualan->penjualandetail[0]->customer->nama_customer }}</option> --}}
                        @foreach ($customer as $c)
                            <option value="{{ $c->id }}"
                                {{ $penjualan->penjualandetail[0]->customer_id === $c->id ? 'selected' : '' }}>
                                {{ $penjualan->customer->nama_customer === $c->nama_customer ? $penjualan->customer->nama_customer : $c->nama_customer }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            @foreach ($penjualandetail as $pd)
                <div class="form-group row  child">
                    <div class="col-md-5">
                        <label for="finishgood_id">Nama Finish Good :</label>
                        <select type="text" name="finishgood_id[]" class="form-control" id="finishgood_id" required>
                            {{-- <option value="">-- Pilih Nama Finish Good --</option> --}}
                            @foreach ($finishgood as $fg)
                                <option value="{{ $fg->id }}" {{ $pd->finishgood->id === $fg->id ? 'selected' : '' }}>
                                    {{ $pd->finishgood->nama_fg === $fg->nama_fg ? $pd->finishgood->nama_fg : $fg->nama_fg }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="jumlah">Jumlah :</label>
                        <input type="number" name="jumlah[]" value="{{ $pd->jumlah }}" class="form-control"
                            id="jumlah" required>
                    </div>
                    <div class="col-md-2 .del">
                        <label>Aksi :</label>
                        <button id="del" name="del" type="button"
                            class="btn btn-sm btn-danger delete-child btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </div>
            @endforeach
            <div class="form-group row add-data child-one">
                <div class="col-md-5">
                    <label for="finishgood_id">Nama Finish Good :</label>
                    <select type="text" name="finishgood_id[]" class="form-control" id="finishgood_id" required>
                        <option value="">-- Pilih Nama Finish Good --</option>
                        @foreach ($finishgood as $fg)
                            <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="jumlah">Jumlah :</label>
                    <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                </div>
                <div class="col-md-2  add">
                    <label>Aksi :</label>
                    <span class="d-flex">
                        <button id="add" name="add" type="button" class="btn btn-sm btn-success mr-1"><i
                                class="fas fa-plus "></i></button>
                        <button id="del" name="del" type="button"
                            class="btn btn-sm btn-danger delete-child btn-danger"><i class="fas fa-trash-alt"></i></button>
                    </span>
                </div>

            </div>

            <div class="form-group row">
                <div class="col-md-12">
                    <label for="satuan">Jenis Pembayaran :</label>
                    <select style="width:100%" name="jenis_pembayaran" id="satuan" class="form-control" required>

                        <option value="Cash" {{ $penjualan->jenis_pembayaran === 'Cash' ? 'selected' : '' }}>Cash
                        </option>
                        <option value="Kredit" {{ $penjualan->jenis_pembayaran === 'Kredit' ? 'selected' : '' }}>Kredit
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label for="ket">Keterangan :</label>
                    <textarea name="keterangan" id="ket" rows="4" class="form-control">{{ $penjualan->keterangan }}</textarea>
                </div>
            </div>

            <input type="submit" class="btn btn-primary btn-send" value="Simpan">
        </form>
    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(add).on('click', function() {
                $('.add-data').append(`
             <div class="form-group row child px-3 mt-3">
                <div class="col-md-5">
                    <label for="finishgood">Nama Finish Good :</label>
                    <select type="text" name="finishgood_id[]" class="form-control" id="finishgood" required>
                        <option value="">-- Pilih Nama Finish Good --</option>
                                @foreach ($finishgood as $fg)
                                    <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                                @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="jumlah">Jumlah :</label>
                    <input type="number" name="jumlah[]" class="form-control" id="jumlah" required>
                </div>
                <div class="col-md-2 add">
                    <label>Aksi :</label>
                    <button id="add" name="add" type="button" class="btn btn-sm btn-danger delete-child btn-danger"><i class="fas fa-trash-alt"></i></button>
                </div>
              </div>
            `)
            })

            $(document).on('click', '.delete-child', function() {
                $(this).parents('.child').remove()
            })
            $(document).on('click', '.delete-child', function() {
                $(this).parents('.child-one').remove()
            })

        })
    </script>

@endsection
