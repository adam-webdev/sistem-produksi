@extends('layouts.layout')
@section('title', 'Bahan Baku')
@section('content')
    @include('sweetalert::alert')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Pembelian Bahan Baku </h1>
        <!-- Button trigger modal -->
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="card-body card">
            <h5 class="text-bold">Material :</h5>
            <div class="row">
                <div class="col-md-3">
                    Kode Material
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->kode_material }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Nama Material
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->nama_material }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Jumlah Material
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->jumlah_material }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Harga
                </div>

                <div class="col-md-3">
                    = @currency($bahanbaku->harga)
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Satuan
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->satuan }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Jenis Material
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->jenis_material }}
                </div>
            </div>
            <h5 class="mt-3 text-bold">Supplier :</h5>
            <div class="row">
                <div class="col-md-3">
                    Nama Supplier
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->supplier->nama }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    No HP
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->supplier->nohp }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Email
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->supplier->email }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Nama Bank
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->supplier->nama_bank }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    No Rekening
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->supplier->no_rekening }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Alamat
                </div>

                <div class="col-md-3">
                    = {{ $bahanbaku->supplier->alamat }}
                </div>
            </div>
            <h5 class="mt-2">Jumlah pembayaran </h5>
            <div class="row">
                <div class="col-md-2">
                    Harga
                </div>
                <div class="col-md-1">
                    x
                </div>
                <div class="col-md-3">
                    Jumlah
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    @currency ($bahanbaku->harga )
                </div>
                <div class="col-md-1">
                    x
                </div>
                <div class="col-md-3">
                    {{ $bahanbaku->jumlah_material }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <hr />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    Total Pembayaran
                </div>
                <div class="col-md-3">
                    = @currency($bahanbaku->harga * $bahanbaku->jumlah_material)
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @foreach ($bahanbaku as $b)
              <tr align="center">
                  <td>{{ $b->kode_material }}</td>
                  <td>{{ $b->nama_material }}</td>
                  <td>{{ $b->jenis_material }}</td>
                  <td>{{ $b->jumlah_material }}</td>
                  <td>{{ $b->satuan }}</td>
                  <td>{{ $b->supplier->nama }}</td>
                  <td align="center" width="10%">
                      @role('Admin')
                          <a href="{{ route('pembelian.detail', [$b->id]) }}" data-toggle="tooltip"
                              title="Detail" class="d-none  d-sm-inline-block btn btn-sm btn-success shadow-sm">
                              <i class="fas fa-eye"></i>
                          </a>
                      @endrole
                  </td>
              </tr>
          @endforeach

</div> --}}
