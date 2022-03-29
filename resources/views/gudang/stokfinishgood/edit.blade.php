@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('stokfinishgood.update', [$stokfinishgood->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Stok Finish Good</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="barang">Nama Finish Good :</label>
                    <select style="width:100%" name="finishgood_id" id="barang" class="form-control select" required>
                        <option value="{{ $stokfinishgood->finishgood_id }}">
                            {{ $stokfinishgood->finishgood->nama_fg }}</option>
                        @foreach ($finishgoods as $fg)
                            <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="satuan">Satuan Barang :</label>
                    <select style="width:100%" name="satuan" id="satuan" class="form-control" required>
                        <option value="{{ $stokfinishgood->satuan }}">{{ $stokfinishgood->satuan }}</option>
                        <option value="Unit">Unit</option>
                        <option value="Kg">Kg</option>
                        <option value="Liter">Liter</option>
                        <option value="Pcs">Pcs</option>
                        <option value="Meter">Meter</option>
                    </select>
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
