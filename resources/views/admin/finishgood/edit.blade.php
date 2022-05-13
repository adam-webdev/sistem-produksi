@extends('layouts.layout')
@section('title', 'Edit Finish Good')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('finish-good.update', [$data->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Data Finish Good</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="nama">Nama Finish Good</label>
                    <input id="nama" type="text" name="nama_fg" class="form-control" required
                        value="{{ $data->nama_fg }}">
                </div>
                <div class="col-md-5">
                    <label for="kode">Kode Finish Good</label>
                    <input id="kode" type="text" name="kode_fg" class="form-control" required
                        value="{{ $data->kode_fg }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="jumlah">Jumlah Finish Good</label>
                    <input id="jumlah" type="number" name="jumlah_fg" class="form-control" required
                        value="{{ $data->jumlah_fg }}">
                </div>
                <div class="col-md-4">
                    <label for="harga">Harga Finish Good :</label>
                    <input type="text" name="harga" class="form-control" id="harga" value="{{ $data->harga }}" required>
                </div>

                <div class="col-md-3">
                    <label for="satuan">Satuan Barang :</label>
                    <select style="width:100%" name="satuan_fg" id="satuan" class="form-control" required>
                        {{-- <option value="{{ $data->satuan_fg }}">{{ $data->satuan_fg }} --}}
                        <option value="Unit" {{ $data->satuan_fg === 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Kg" {{ $data->satuan_fg === 'Kg' ? 'selected' : '' }}>Kg</option>
                        <option value="Liter" {{ $data->satuan_fg === 'Liter' ? 'selected' : '' }}>Liter
                        </option>
                        <option value="Pcs" {{ $data->satuan_fg === 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Meter" {{ $data->satuan_fg === 'Meter' ? 'selected' : '' }}>Meter
                        </option>
                    </select>
                </div>
            </div>
            <div class="form-group row">

                <div class="col-md-5">
                    <label for="barang">Jenis Warna Finish Good :</label>
                    <select style="width:100%" name="jeniswarna_fg" id="barang" class="form-control select" required>
                        {{-- <option value="{{ $data->jeniswarna_fg }}">{{ $data->jeniswarna_fg }} --}}
                        </option>
                        <option value="Red" {{ $data->jeniswarna_fg === 'Red' ? 'selected' : '' }}>Red</option>
                        <option value="White" {{ $data->jeniswarna_fg === 'White' ? 'selected' : '' }}>White</option>
                        <option value="Blue" {{ $data->jeniswarna_fg === 'Blue' ? 'selected' : '' }}>Blue</option>
                        <option value="Green" {{ $data->jeniswarna_fg === 'Green' ? 'selected' : '' }}>Green</option>
                        <option value="Black " {{ $data->jeniswarna_fg === 'Black' ? 'selected' : '' }}>Black</option>
                        <option value="Gold" {{ $data->jeniswarna_fg === 'Gold' ? 'selected' : '' }}>Gold</option>
                        <option value="Yellow" {{ $data->jeniswarna_fg === 'Yellow' ? 'selected' : '' }}>Yellow</option>
                    </select>
                </div>
            </div>

            <input type="submit" class="btn btn-success btn-send" value="Update">
            <input type="Button" class="btn btn-primary btn-send" value="Kembali" onclick="history.go(-1)">
        </fieldset>
    </form>
@endsection
{{-- @section('scripts')
     <script>
        $(document).ready(function() {
            $('.select').select2({
                tags:true,
                width:'resolve'
            });
        });
    </script>
@endsection --}}
