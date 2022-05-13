@extends('layouts.layout')
@section('title', 'Edit Stok Finish Good')
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
                        {{-- <option value="{{ $stokfinishgood->finishgood_id }}">
                            {{ $stokfinishgood->finishgood->nama_fg }}</option> --}}
                        @foreach ($finishgoods as $fg)
                            <option value="{{ $fg->id }}"
                                {{ $stokfinishgood->finishgood_id === $fg->id ? 'selected' : '' }}>
                                {{ $stokfinishgood->finishgood->nama_fg === $fg->nama_fg ? $stokfinishgood->finishgood->nama_fg : $fg->nama_fg }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="satuan">Satuan Barang :</label>
                    <select style="width:100%" name="satuan" id="satuan" class="form-control" required>
                        {{-- <option value="{{ $stokfinishgood->satuan === 'Unit' ? 'selected' : '' }}">
                            {{ $stokfinishgood->satuan }}</option> --}}
                        <option value="Unit" {{ $stokfinishgood->satuan === 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Kg" {{ $stokfinishgood->satuan === 'Kg' ? 'selected' : '' }}>Kg</option>
                        <option value="Liter" {{ $stokfinishgood->satuan === 'Liter' ? 'selected' : '' }}>Liter</option>
                        <option value="Pcs" {{ $stokfinishgood->satuan === 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Meter" {{ $stokfinishgood->satuan === 'Meter' ? 'selected' : '' }}>Meter</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="jumlah_barang">Jumlah :</label>
                    <input type="number" value="{{ $stokfinishgood->jumlah }}" name="jumlah" class="form-control"
                        id="jumlah_barang" required>
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
