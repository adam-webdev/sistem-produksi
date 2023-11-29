@extends('layouts.layout')
@section('title', 'Jadwal Produksi')
@section('content')
    @include('sweetalert::alert')


    <div class="row">
        <div class="col-md-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class=" mb-0 text-gray-800">Informasi Produk Terlaris </h4>
                <!-- Button trigger modal -->

            </div>
            <div class="card p-4 ">
                <div class="d-flex w-60 gap-5 mb-2">
                    {{-- <h5 class="text-dark">Produk Terlaris </h5> --}}
                    <select type="text" name="bulan" id="bulan">
                        <option value="">--pilih bulan--</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    @php
                        $tahun_sekarang = date('Y');
                        $tahun_list = range($tahun_sekarang - 5, $tahun_sekarang);

                    @endphp
                    <select type="number" name="tahun" id="tahun" class=" ml-2">
                        <option value="">--pilih tahun--</option>
                        @foreach ($tahun_list as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr class="font-weight-bold">
                            <td>No</td>
                            <td>Nama Produk</td>
                            <td>Jumlah Terjual</td>
                            <td>Bulan</td>
                            <td>Tahun</td>
                        </tr>
                        <tbody id="data-produk">
                            @foreach ($produk_terlaris as $pt)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pt->nama_fg }}</td>
                                    <td>{{ $pt->jumlah_penjualan }}</td>
                                    <td>{{ $pt->bulan }}</td>
                                    <td>{{ $pt->tahun }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h4 class=" mb-0 text-gray-800">Input Jadwal Produksi </h4>
                <!-- Button trigger modal -->

            </div>
            <div class="card p-4">
                <form action="{{ route('jadwal-produksi.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex pt-3 pl-3 mb-4"
                            style="border-radius:8px;background-color: rgb(213, 248, 216)!important">
                            <i class="fas fa-info-circle mr-2" style="font-size: 20px;color:rgb(12, 108, 12);"></i>
                            <p style="color:rgb(12, 108, 12);font-weight:bold;">Lihat produk terlaris, sebagai informasi
                                untuk
                                perencanaan produksi hari
                                ini</p>
                        </div>
                        <div class="form-group">
                            <label for="kode">Kode Jadwal Produksi :</label>
                            <input type="text" name="kode" class="form-control" id="kode"
                                value="{{ $kodeGenerator }}" readonly required>
                        </div>
                        <div class="form-group row align-items-center add-data">
                            <div class="col-md-6">
                                <label for="barang">Finish Good :</label>
                                <select style="width:100%" name="finishgood_id[]" id="barang" class="form-control  "
                                    required>
                                    <option selected disabled value="">-- Pilih Finish Good --</option>
                                    @foreach ($finishgoods as $fg)
                                        <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="barang">Target Produksi :</label>
                                <input type="number" name="target[]" class="form-control" id="barang" required>
                            </div>

                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button id="add" name="add" type="button" class="btn btn-sm btn-success"><i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="barang">Tanggal :</label>
                            <input type="date" name="tanggal" class="form-control" id="barang" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Batal</button>
                        <input type="submit" class="btn btn-primary btn-send" value="Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.select').select2({
                tags: true,
                width: 'resolve'
            });
            // produk terlaris
            $('#bulan, #tahun').on('change', function() {
                var bulan = $('#bulan').val()
                var tahun = $('#tahun').val()
                console.log(bulan)
                console.log(tahun)
                $.ajax({
                    type: 'GET',
                    url: "{{ route('produkterlaris') }}",
                    data: {
                        bulan: bulan,
                        tahun: tahun
                    },
                    success: function(data) {
                        console.log("data : ", data)

                        if (data.length == 0) {
                            $('#data-produk').html(`
                              <tr align="center"><td colspan="5">Data tidak ditemukan!</td></tr>
                          `)
                        } else {
                            $('#data-produk').html(
                                data.map((item, index) => {
                                    return `<tr>
                                              <td>${index+1}</td>
                                              <td>${item.nama_fg}</td>
                                              <td>${item.jumlah_penjualan}</td>
                                              <td>${item.bulan}</td>
                                              <td>${item.tahun}</td>
                                          </tr>`
                                })

                            )
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText)
                    }
                })
            })

        });

        $(add).on('click', function() {
            $('.add-data').append(`<div class="form-group px-3 mt-2 row child align-items-center">
                            <div class="col-md-6">
                                <label for="barang">Finish Good :</label>
                                <select style="width:100%" name="finishgood_id[]" id="barang" class="form-control "
                                    required>
                                    <option selected disabled value="">-- Pilih Finish Good --</option>
                                    @foreach ($finishgoods as $fg)
                                        <option value="{{ $fg->id }}">{{ $fg->nama_fg }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="barang">Target Produksi :</label>
                                <input type="number" name="target[]" class="form-control" id="barang" required>
                            </div>
                            <div class="col-md-2 add">
                                <label>Aksi :</label>
                                <button type="button" class="btn btn-sm  delete-child btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                         `)
        })
        $(document).on('click', '.delete-child', function() {
            $(this).parents('.child').remove()
        })
    </script>
@endsection
