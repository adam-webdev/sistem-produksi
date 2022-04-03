@extends('layouts.layout')
@section('title', 'Edit Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('bahan-baku.update', [$bahanbaku->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Data Material</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="jumlah_barang">Nama Material</label>
                    <input id="jumlah_barang" type="text" name="nama_material" class="form-control" required
                        value="{{ $bahanbaku->nama_material }}">
                </div>
                <div class="col-md-5">
                    <label for="jumlah_barang">Kode Material</label>
                    <input id="jumlah_barang" type="text" name="kode_material" class="form-control" required
                        value="{{ $bahanbaku->kode_material }}">
                </div>
                <div class="col-md-5">
                    <label for="barang">Jenis Material :</label>
                    <select style="width:100%" name="jenis_material" id="barang" class="form-control select" required>
                        <option value="{{ $bahanbaku->jenis_material }}">{{ $bahanbaku->jenis_material }}
                        </option>
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
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
