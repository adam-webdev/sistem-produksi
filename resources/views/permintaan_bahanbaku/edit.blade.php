@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('permintaan-bahanbaku.update', [$data->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Material Masuk</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="barang">Nama Material :</label>
                    <select style="width:100%" name="bahanbaku_id" id="barang" class="form-control select" required>
                        <option disabled value="{{ $data->bahanbaku->id }}">
                            {{ $data->bahanbaku->nama_material }}</option>
                        @foreach ($bahanbaku as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_material }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label for="jumlah_barang">Jumlah Material :</label>
                    <input type="number" value="{{ $data->jumlah_material }}" name="jumlah_material" class="form-control"
                        id="jumlah_barang">

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
