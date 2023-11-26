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
                    <label for="jumlah">Jumlah Material :</label>
                    <input type="text" name="jumlah_material" value="{{ $bahanbaku->jumlah_material }}"
                        class="form-control" id="jumlah" required>
                </div>
                <div class="col-md-5">
                    <label for="harga">Harga Material :</label>
                    <input type="text" name="harga" value="{{ $bahanbaku->harga }}" class="form-control" id="harga"
                        required>
                </div>
                <div class="col-md-5">
                    <label for="satuan">Satuan Barang :</label>
                    <select style="width:100%" name="satuan" id="satuan" class="form-control" required>
                        <option value="{{ $bahanbaku->satuan }}">{{ $bahanbaku->satuan }}</option>
                        <option value="Unit" {{ $bahanbaku->satuan === 'Unit' ? 'selected' : '' }}>Unit</option>
                        <option value="Kg" {{ $bahanbaku->satuan === 'Kg' ? 'selected' : '' }}>Kg</option>
                        <option value="Liter" {{ $bahanbaku->satuan === 'Liter' ? 'selected' : '' }}>Liter</option>
                        <option value="Pcs" {{ $bahanbaku->satuan === 'Pcs' ? 'selected' : '' }}>Pcs</option>
                        <option value="Meter" {{ $bahanbaku->satuan === 'Meter' ? 'selected' : '' }}>Meter</option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="barang">Jenis Material :</label>
                    <select style="width:100%" name="jenis_material" id="barang" class="form-control select" required>
                        {{-- <option value="{{ $bahanbaku->jenis_material }}">{{ $bahanbaku->jenis_material }}
                        </option> --}} <option disabled selected value="">-- Pilih Jenis Material --</option>

                        <option value="Besi" {{ $bahanbaku->jenis_material === 'Besi' ? 'selected' : '' }}>Besi</option>
                        <option value="Kayu" {{ $bahanbaku->jenis_material === 'Kayu' ? 'selected' : '' }}>Kayu</option>
                        <option value="Plastik" {{ $bahanbaku->jenis_material === 'Plastik' ? 'selected' : '' }}>Plastik
                        </option>
                        <option value="Kaca" {{ $bahanbaku->jenis_material === 'Kaca' ? 'selected' : '' }}>Kaca</option>
                        <option value="Alumuium" {{ $bahanbaku->jenis_material === 'Alumuium' ? 'selected' : '' }}>Alumuium
                        </option>
                        <option value="Kertas" {{ $bahanbaku->jenis_material === 'Kertas' ? 'selected' : '' }}>Kertas
                        </option>
                    </select>
                </div>
                <div class="col-md-5">
                    <label for="supplier">Supplier :</label>
                    <select type="text" name="supplier_id" class="form-control" id="supplier" required>
                        {{-- <option disabled value="{{ $bahanbaku->supplier_id }}">{{ $bahanbaku->supplier->nama }}
                        </option> --}}
                        @foreach ($supplier as $s)
                            <option value="{{ $s->id }}"
                                {{ $bahanbaku->supplier_id === $s->id ? 'selected' : '' }}>
                                {{ $bahanbaku->supplier->nama === $s->nama ? $bahanbaku->supplier->nama : $s->nama }}
                            </option>
                        @endforeach
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
