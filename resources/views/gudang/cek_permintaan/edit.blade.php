@extends('layouts.layout')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('cek-permintaan.update', [$data->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Status</legend>

            <div class="form-group row">
                <div class="col-md-5">
                    <label for="status">Status :</label>
                    <select style="width:100%" name="status" id="status" class="form-control" required>
                        <option disabled value="{{ $data->status }}">{{ $data->status }}</option>
                        <option value="Permintaan Diterima">Permintaan Diterima</option>
                    </select>
                </div>
            </div>

            <button type="button" class="btn btn-secondary" onclick="history.go(-1)"> Batal</button>
            <input type="submit" class="btn btn-primary btn-send" value="Simpan">
        </fieldset>
    </form>
@endsection
