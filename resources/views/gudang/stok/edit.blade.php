@extends('layouts.layout')
@section('title', 'Edit Stok Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('stok.update', [$stok->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Material Masuk</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="barang">Nama Material :</label>
                    <select style="width:100%" name="bahanbaku_id" id="barang" class="form-control select" required>
                        {{-- <option disabled value="{{ $stok->bahanbaku->id }}">
                            {{ $stok->bahanbaku->nama_material }}</option> --}}
                        @foreach ($bahanbaku as $b)
                            <option value="{{ $b->id }}" {{ $stok->bahanbaku->id === $b->id ? 'selected' : '' }}>
                                {{ $stok->bahanbaku->nama_material === $b->nama_material ? $stok->bahanbaku->nama_material : $b->nama_material }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">

                    <label for="satuan">Satuan Barang :</label>
                    <select style="width:100%" name="satuan" id="satuan" class="form-control select" required>
                        <option value="{{ $stok->satuan }}">{{ $stok->satuan }}</option>
                        <option value="Unit" {{ $stok->satuan == 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Kg" {{ $stok->satuan == 'Kg' ? 'selected' : '' }}>Kg</option>
                        <option value="Liter" {{ $stok->satuan == 'Liter' ? 'selected' : '' }}>Liter</option>
                        <option value="Pcs" {{ $stok->satuan == 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Meter" {{ $stok->satuan == 'Meter' ? 'selected' : '' }}>Meter</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="jumlah_barang">Jumlah :</label>
                    <input type="number" value="{{ $stok->jumlah_material }}" name="jumlah" class="form-control"
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
