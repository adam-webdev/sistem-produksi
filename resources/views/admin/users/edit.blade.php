@extends('layouts.layout')
@section('title', 'Edit Data User')
@section('content')
    @include('sweetalert::alert')
    <form action="{{ route('user.update', [$user->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <fieldset>
            <legend>Edit Data User</legend>
            <div class="form-group row">
                <div class="col-md-5">
                    <label for="username">Username :</label>
                    <input id="username" type="text" name="username" class="form-control" required
                        value="{{ $user->name }}">
                </div>
                <div class="col-md-5">
                    <label for="email">Email :</label>
                    <input id="email" type="email" name="email" class="form-control" required value="{{ $user->email }}">
                </div>
                <div class="col-md-5">
                    <label for="email">Password :</label>
                    <input id="email" type="password" name="email" class="form-control" required
                        value="{{ $user->password }}">
                </div>

                <div class="col-md-5">
                    <label for="roles"> :</label>
                    <select style="width:100%" name="jenis_material" id="roles" class="form-control select" required>
                        <option value="{{ $user->roles }}">{{ $user->roles }}
                        </option>
                        <option value="admin">Admin</option>
                        <option value="direktur">Direktur</option>
                        <option value="gudang">Gudang</option>
                        <option value="produksi">Produksi</option>
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
