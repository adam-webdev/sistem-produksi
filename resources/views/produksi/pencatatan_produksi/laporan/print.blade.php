<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
    <style>
        .header {
            display: flex;
            position: relative;
            justify-content: space-between;
            width: 100%;
            align-items: center;
        }


        .text {
            display: flex;
            align-items: center;
            justify-content: center;

        }

        hr {
            margin-bottom: 30px;
        }

    </style>
</head>

<body>
    <div class="header">
        <div class=" text">
            <h2>CV. Mutiara Kencana</h2>
            <p>Jl. Pengasinan Bekasi 17510</p>
            <p>Email : cv-mutiara-kencana@gmail.com Fax :202020</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <h5 class="text-center">
            {{ $periode == 'all'? 'Laporan Produksi all ': 'Laporan Produksi Per-periode ' . $tgl_awal . ' sampai dengan ' . $tgl_akhir }}
        </h5>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <table class="table table-striped table-bordered align-items-center" width="100%" cellspacing="0">
            <thead>
                <tr align="center">
                    <th width="2%">No</th>
                    <th>No Produksi</th>
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th> Target Yang Diharapkan </th>
                    <th> Target Yang Diselesaikan </th>
                    <th> Persentase Keberhasilan </th>
                    {{-- <th> Status </th> --}}
                    {{-- <th> Keterangan </th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $r)
                    <tr>
                        <td width="2%">{{ $loop->iteration }}</td>
                        <td>{{ $r->jadwalproduksi->kode_jadwalproduksi }}</td>
                        <td>{{ $r->jadwalproduksi->tanggal }}</td>
                        <td>{{ $r->finishgood->nama_fg }}</td>
                        {{-- <td>{{ $r->created_at->format('d-m-Y') }}</td> --}}
                        <td>{{ $r->jadwalproduksi->jumlah_barang }}</td>
                        <td>{{ $r->jumlah }}</td>
                        @if ($r->jumlah >= $r->jadwalproduksi->jumlah_barang)
                            <td> <span class="text-success font-weight-bold">+ </span>
                                {{ ($r->jumlah / $r->jadwalproduksi->jumlah_barang) * 100 }}
                                %</td>
                        @else
                            <td> <span class="text-danger font-weight-bold">- </span>
                                {{ ($r->jumlah / $r->jadwalproduksi->jumlah_barang) * 100 }}
                                %</td>
                        @endif
                        {{-- @if ($r->jumlah >= $r->jadwalproduksi->jumlah_barang)
                            <td><span class="btn btn-sm btn-light shadow-sm text-success">Tercapai</span></td>
                        @else
                            <td width="150px">
                                <span class="btn btn-sm btn-light shadow-sm text-danger">Belum Tercapai</span>
                            </td>
                        @endif
                        <td>{{ $r->keterangan }}</td> --}}
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
{{-- @endsection --}}
