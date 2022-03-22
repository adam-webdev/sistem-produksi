@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('jadwal-produksi.update', [$data->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Data Material</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="nama">Nama Barang</label>
                    <input id="nama" type="text" name="nama_barang" class="form-control" required
                        value="{{ $data->nama_barang }}">
                </div>
                <div class="col-md-5">
                    <label for="tanggal">Tanggal Produksi</label>
                    <input id="tanggal" type="date" name="tanggal" class="form-control" required
                        value="{{ $data->tanggal }}">
                </div>
                <div class="col-md-5">
                    <label for="tanggal">Jumalah Barang</label>
                    <input id="tanggal" type="number" name="target" class="form-control" required
                        value="{{ $data->jumlah_barang }}">
                </div>
                <div class="col-md-5">
                    <label for="jenis">Jenis Warna Barang :</label>
                    <select style="width:100%" name="jenis" id="jenis" class="form-control select" required>
                        <option value="Tidak ada" {{ $data->jeniswarna_barang === 'Tidak ada' ? 'selected' : '' }}>Tidak
                            ada
                        </option>
                        <option value="Red" {{ $data->jeniswarna_barang === 'Red' ? 'selected' : '' }}>Red</option>
                        <option value="White" {{ $data->jeniswarna_barang === 'White' ? 'selected' : '' }}>White</option>
                        <option value="Black" {{ $data->jeniswarna_barang === 'Black' ? 'selected' : '' }}>Black</option>
                        <option value="Green" {{ $data->jeniswarna_barang === 'Green' ? 'selected' : '' }}>Green</option>
                        <option value="Yellow" {{ $data->jeniswarna_barang === 'Yellow' ? 'selected' : '' }}>Yellow
                        </option>
                        <option value="Gold" {{ $data->jeniswarna_barang === 'Gold' ? 'selected' : '' }}>Gold</option>
                        <option value="Blue" {{ $data->jeniswarna_barang === 'Blue' ? 'selected' : '' }}>Blue</option>
                    </select>
                </div>
            </div>

            <input type="submit" class="btn btn-success btn-send" value="Update">
            <input type="Button" class="btn btn-primary btn-send" value="Kembali" onclick="history.go(-1)">
        </fieldset>
    </form>
@endsection
