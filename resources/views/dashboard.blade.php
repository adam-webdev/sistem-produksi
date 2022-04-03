@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
    <div class="card">
        <h4 class="p-2">Selamat Datang <b>{{ Auth::user()->name }}</b></h4>
    </div>

    {{-- <div class="row align-items-center">
        <div class="col-md-4 ml-4">
            <img width="400px" height="400px" src="{{asset("asset/img/company.svg")}}" alt="">
        </div>
        <div class="col-md-6">
            <div class="card p-4">
            @foreach ($perusahaan as $perusahaan)
                <h4>{{$perusahaan->nama_usaha}}</h4>
                <p>{{$perusahaan->alamat}}</p>
                <p>{{$perusahaan->email}}</p>
                <p>{{$perusahaan->telepon}}</p>
            @endforeach

        </div>

        </div>
    </div> --}}
@endsection
