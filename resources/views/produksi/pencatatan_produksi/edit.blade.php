@extends('layouts.layout')
@section('title', 'Edit Hasil Produksi')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('pencatatan-produksi.update', [$data->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Pencatatan Produksi</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="barang">Nama Barang :</label>
                    <select style="width:100%" name="jadwalproduksi_id" id="barang" class="form-control select" required>
                        <option disabled value="{{ $data->jadwalproduksi_id }}">
                            {{ $data->stokfinishgood->finishgood->nama_fg }}</option>
                        @foreach ($jadwalproduksi as $jp)
                            <option value="{{ $jp->id }}">{{ $jp->stokfinishgood->finishgood->nama_fg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="barang">Nama Barang :</label>
                    <select style="width:100%" name="stokfinishgood_id" id="barang" class="form-control select" required>
                        <option disabled value="{{ $data->stokfinishgood_id }}">
                            {{ $data->stokfinishgood->finishgood->nama_fg }}</option>
                        @foreach ($stokfinishgood as $sfg)
                            <option value="{{ $sfg->id }}">{{ $sfg->finishgood->nama_fg }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-5">
                    <label for="keterangan">Keterangan :</label>
                    <textarea rows="5" id="keterangan" type="text" name="keterangan" class="form-control" required
                        value="{{ $data->keterangan }}">{{ $data->keterangan }}</textarea>
                </div>
                <div class="col-md-5">
                    <label for="jumlah_barang">Jumlah Barang :</label>
                    <input id="jumlah_barang" type="text" name="jumlah" class="form-control" required readonly
                        value="{{ $data->jumlah }}">
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
