<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> @yield('title')</title>
    <link href="{{ asset('asset/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('asset/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    @yield('meta')

</head>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-primary  accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center"
                href="{{ route('dashboard.index') }}">
                <div class="sidebar-brand-icon rotate-n-0">
                    <img src="{{ asset('asset/img/logos.jpg') }}" width="60">
                </div>
                <div class="sidebar-brand-text text-white mx-2">CV Mutiara Kencana</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            @hasanyrole('Admin|Direktur')
                <li class="nav-item">
                    <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas  fa-fw fa-table"></i>
                        <span>Data Master</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item fas fa-archive" href="{{ route('bahan-baku.index') }}">
                                Bahan Baku
                            </a>
                            <a class="collapse-item fas fa-car" href="{{ route('supplier.index') }}">
                                Supplier
                                <a class="collapse-item fas fa-digital-tachograph" href="{{ route('customer.index') }}">
                                    Customer
                                </a>
                                <a class="collapse-item fas fa-clipboard-check" href="{{ route('finish-good.index') }}">
                                    Barang Finish Good</a>
                                <a class="collapse-item fas fa-users" href="{{ route('user.index') }}">
                                    User</a>


                        </div>
                    </div>
                </li>
            @endhasanyrole
            @hasanyrole('Admin|Direktur|Produksi')
                <li class="nav-item">
                    <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapsePages1"
                        aria-expanded="true" aria-controls="collapsePages1">
                        <i class="fas fa-fw fa-briefcase"></i>
                        <span>Produksi</span>
                    </a>

                    <div id="collapsePages1" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item fas fa-hands" href="{{ route('permintaan-bahanbaku.index') }}">
                                Permintaan Bahan Baku</a>
                            <a class="collapse-item fas fa-box-open" href="{{ route('pencatatan-produksi.index') }}">
                                Hasil Produksi</a>
                            <a class="collapse-item fas fa-hourglass-half"
                                href="{{ route('cek-jadwalproduksi.index') }}">
                                Cek Jadwal Produksi</a>
                        </div>
                    </div>
                </li>
            @endhasanyrole
            @hasanyrole('Admin|Direktur|Gudang')
                <li class="nav-item">
                    <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapsePages2"
                        aria-expanded="true" aria-controls="collapsePage2">
                        <i class="fas fa-fw fa-warehouse"></i>
                        <span>Gudang</span>
                    </a>
                    <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">

                            {{-- <a class="collapse-item fas fa-box" href="{{ route('stok.index') }}"> Stok
                                Bahan Baku</a>
                            <a class="collapse-item fas fa-check-double" href="{{ route('stokfinishgood.index') }}"> Stok
                                Finish Good</a> --}}
                            <a class="collapse-item fas fa-door-open" href="{{ route('bahanbaku-masuk.index') }}"> Bahan
                                Baku Masuk</a>
                            <a class="collapse-item fas fa-external-link-alt"
                                href="{{ route('bahanbaku-keluar.index') }}"> Bahan Baku Keluar</a>
                            <a class="collapse-item fas fa-hourglass-half" href="{{ route('jadwal-produksi.index') }}">
                                Jadwal Produksi</a>
                            <a class="collapse-item fas fa-hands" href="{{ route('cek-permintaan.index') }}">
                                Permintaan Produksi</a>
                        </div>
                    </div>
                </li>
            @endhasanyrole
            <li class="nav-item">
                <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapsePages4"
                    aria-expanded="true" aria-controls="collapsePage4">
                    <i class="fas fa-fw fa-money-bill-wave"></i>
                    <span>Transaksi</span>
                </a>
                <div id="collapsePages4" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @hasanyrole('Admin|Direktur|Gudang')
                            <a class="collapse-item fas  fa-shopping-basket" href="{{ route('pembelian.index') }}">
                                Pembelian </a>
                            <a class="collapse-item fas fa-money-bill-alt" href="{{ route('penjualan.index') }}">
                                Penjualan </a>
                        @endhasanyrole


                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapsePages3"
                    aria-expanded="true" aria-controls="collapsePage3">
                    <i class="fas fa-fw fa-file-pdf"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapsePages3" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        {{-- @hasanyrole('Admin|Direktur')
                            <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('laporan.bahanbaku') }}">
                                Bahan Baku </a>
                            <a class="collapse-item fas fa-arrow-circle-right" href="{{ route('laporan.finishgood') }}">
                                Finish Good </a>
                        @endhasanyrole --}}

                        @hasanyrole('Admin|Direktur')
                            <a class="collapse-item fas fa-shopping-basket" href="{{ route('laporan.pembelian') }}">
                                Pembelian </a>
                            <a class="collapse-item fas fa-money-bill-alt" href="{{ route('laporan.penjualan') }}">
                                Penjualan </a>
                            <a class="collapse-item fas fa-book" href="{{ route('laporan.hutang') }}">
                                Hutang </a>
                            <a class="collapse-item fas fa-credit-card" href="{{ route('laporan.piutang') }}">
                                Piutang </a>
                            {{-- <a class="collapse-item fas fa-hourglass-half" href="{{ route('laporan.jadwalproduksi') }}">
                                Jadwal Produksi </a>
                            <a class="collapse-item fas fa-external-link-alt"
                                href="{{ route('laporan.bahanbaku_keluar') }}">
                                Bahan Baku Keluar </a>
                            <a class="collapse-item fas fa-door-open" href="{{ route('laporan.bahanbaku_masuk') }}">
                                Bahan Baku Masuk </a>
                            <a class="collapse-item fas fa-box" href="{{ route('laporan.stok') }}">
                                Stok Bahan Baku </a>
                            <a class="collapse-item fas fa-check-double" href="{{ route('laporan.stokfinishgood') }}">
                                Stok Finsih Good </a> --}}
                        @endhasanyrole

                        @hasanyrole('Admin|Direktur|Produksi')
                            <a class="collapse-item fas fa-hands" href="{{ route('laporan.pencatatanproduksi') }}">
                                Produksi </a>
                            {{-- <a class="collapse-item fas fa-archive" href="{{ route('laporan.permintaanbahanbaku') }}">
                                Permintaan Bahan Baku </a> --}}
                        @endhasanyrole

                    </div>
                </div>
            </li>

            <!-- Nav Item - Tables -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <div class="input-group-append">
                                <h4>Sistem Informasi Produksi</h4>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('asset/img/avatar2.png') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <!-- Page Heading -->
                    @yield('content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Create By: Skripsiku<br>Copyright &copy; CV mutiara kencana
                            {{ \Carbon\Carbon::now()->year }} </span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar aplikasi ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" apabila ingin keluar aplikasi</div>
                <div class="modal-footer">
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src={{ asset('asset/vendor/jquery/jquery.min.js') }}></script>
    <script src={{ asset('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') }}></script>

    <!-- Core plugin JavaScript-->
    <script src={{ asset('asset/vendor/jquery-easing/jquery.easing.min.js') }}></script>

    <!-- Custom scripts for all pages-->
    <script src={{ asset('asset/js/sb-admin-2.min.js') }}></script>

    <!-- Page level plugins -->
    <script src={{ asset('asset/vendor/chart.js/Chart.min.js') }}></script>
    <script src={{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}></script>
    <script src={{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.js') }}></script>

    <!-- Page level custom scripts -->
    <script src={{ asset('asset/js/demo/chart-area-demo.js') }}></script>
    <script src={{ asset('asset/js/demo/chart-pie-demo.js') }}></script>
    <script src={{ asset('asset/js/demo/datatables-demo.js') }}></script>
    <script src="{{ asset('asset/vendor/select2/dist/js/select2.min.js') }}"></script>
    @yield('scripts')

</body>

</html>
