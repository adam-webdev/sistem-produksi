@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('bahanbaku-keluar.update', [$bahanbaku_keluar->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Material Kelaur</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="barang">Nama Material :</label>
                    <select style="width:100%" name="bahanbaku_id" id="barang" class="form-control select" required>
                        <option value="{{ $bahanbaku_keluar->bahanbaku->id }}">
                            {{ $bahanbaku_keluar->bahanbaku->nama_material }}</option>
                        @foreach ($bahanbaku as $b)
                            <option value="{{ $b->id }}">{{ $b->nama_material }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-5">
                    <label for="jumlah_barang">Jumlah_Barang</label>
                    <input id="jumlah_barang" type="text" name="jumlah" class="form-control" required
                        value="{{ $bahanbaku_keluar->jumlah }}">
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
