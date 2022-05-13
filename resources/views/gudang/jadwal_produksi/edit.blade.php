@extends('layouts.layout')
@section('title', 'Edit Jadwal Produksi')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('jadwal-produksi.update', [$data->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Data Jadwal Produksi</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="barang">Nama Finish Good :</label>
                    <select style="width:100%" name="finishgood_id" id="barang" class="form-control select" required>
                        {{-- <option value="{{ $data->finishgood_id }}">
                            {{ $data->finishgood->nama_fg }}</option> --}}
                        @foreach ($finishgoods as $fg)
                            <option value="{{ $fg->id }}" {{ $data->finishgood_id === $fg->id ? 'selected' : '' }}>
                                {{ $data->finishgood->nama_fg === $fg->nama_fg ? $data->finishgood->nama_fg : $fg->nama_fg }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="tanggal">Tanggal Produksi</label>
                    <input id="tanggal" type="date" name="tanggal" class="form-control" required
                        value="{{ $data->tanggal }}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="tanggal">Jumalah Barang</label>
                    <input id="tanggal" type="number" name="target" class="form-control" required
                        value="{{ $data->jumlah_barang }}">
                </div>
            </div>
            <input type="submit" class="btn btn-success btn-send" value="Update">
            <input type="Button" class="btn btn-primary btn-send" value="Kembali" onclick="history.go(-1)">
        </fieldset>
    </form>
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
