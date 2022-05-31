@extends('layouts.layout')
@section('title', 'Edit supplier')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('supplier.update', [$data->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Data Supplier</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="nama">Nama :</label>
                    <input id="nama" type="text" name="nama" class="form-control" required value="{{ $data->nama }}">
                </div>
                <div class="col-md-5">
                    <label for="nohp">No HP :</label>
                    <input id="nohp" type="number" name="nohp" class="form-control" required value="{{ $data->nohp }}">
                </div>
                <div class="col-md-5">
                    <label for="email">Email :</label>
                    <input type="text" name="email" value="{{ $data->email }}" class="form-control" id="email" required>
                </div>
                <div class="col-md-5">
                    <label for="nama">Nama Bank :</label>
                    <select name="nama_bank" id="nama" class="form-control">
                        {{-- <option value="{{ $data->nama_bank }}"> {{ $data->nama_bank }}</option> --}}
                        <option value="BRI" {{ $data->nama_bank === 'BRI' ? 'selected' : '' }}> Bank BRI</option>
                        <option value="Mandiri" {{ $data->nama_bank === 'Mandiri' ? 'selected' : '' }}>Bank Mandiri
                        </option>
                        <option value="BCA" {{ $data->nama_bank === 'BCA' ? 'selected' : '' }}>Bank BCA</option>
                        <option value="BTN" {{ $data->nama_bank === 'BTN' ? 'selected' : '' }}>Bank BTN</option>
                        <option value="Permata" {{ $data->nama_bank === 'Permata' ? 'selected' : '' }}>Bank Permata
                        </option>
                        <option value="Syariah" {{ $data->nama_bank === 'Syariah' ? 'selected' : '' }}>Bank Syariah
                        </option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="no">No Rekening :</label>
                    <input type="text" name="no_rekening" value="{{ $data->no_rekening }}" class="form-control" id="no"
                        required>
                </div>
                <div class="col-md-5">
                    <label for="alamat">Alamat :</label>
                    <textarea type="text" rows="5" name="alamat" class="form-control" id="alamat"
                        required> {{ $data->alamat }}</textarea>
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
