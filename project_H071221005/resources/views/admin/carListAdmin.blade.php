<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('tampilan/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('tampilan/css/sb-admin-2.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- batas untuk fix navbar kiri -->
    <style>
        /* fixed navbar kiri */
        #accordionSidebar {
            position: fixed;
        }

        #content {
            margin-left: 225px;
        }
    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layouts.navbar-admin')

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
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                        action="{{ route('carListAdmin') }}" method="GET">
                        <div class="input-group">
                            <input type="search" class="form-control bg-light border-0 small"
                                placeholder="Cari Merk Mobil" aria-label="Search" aria-describedby="basic-addon2"
                                name="search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Formulir Filter -->
                    <form class="form-inline mb-2" action="{{ route('carListAdmin') }}" method="GET">
                        <div class="form-group mr-2">
                            <label for="transmissionFilter">Filter Transmisi:</label>
                            <select class="form-control" id="transmissionFilter" name="transmission">
                                <option value="">Semua</option>
                                <!-- pakai request agar misalnya jiak diklik "otomatis" akan tetap dengan nama "otomatis -->
                                <option value="manual" {{ request('transmission')=='manual' ? 'selected' : '' }}>Manual
                                </option>
                                <option value="otomatis" {{ request('transmission')=='otomatis' ? 'selected' : '' }}>
                                    Otomatis</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    <!-- ... (lanjutkan dengan bagian selanjutnya) ... -->



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



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('tampilan/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0  text-gray-800" style="margin-left: 50px;">Car List</h1>

                        <!-- Formulir Pencarian -->

                    </div>

                    <div class="container mt-8" style="margin-left: 150px;">
                        <!-- Ganti nilai margin-left sesuai kebutuhan -->
                        @foreach($cars as $car)
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <img src="{{ asset('storage/'.$car->gambar_path) }}" alt="Car Image" class="img-fluid"
                                    width="350" height="200">
                            </div>
                            <div class="col-md-6 ml-auto">
                                <h2>{{ $car->merk }} {{ $car->model }}</h2>
                                <p><strong>Plat:</strong> {{ $car->plat }}</p>
                                <p><strong>Tahun:</strong> {{ $car->tahun }}</p>
                                <p><strong>Transmisi:</strong> {{ $car->transmisi }}</p>
                                <p><strong>Rp/Hari:</strong> Rp.{{ $car->harga_per_hari }}</p>
                                <p>
                                    <strong>Status:</strong>
                                    @if($car->status == 'Available')
                                    <span style="color: #00ff30; font-weight: bold;">{{ $car->status }}</span>
                                    @elseif($car->status == 'Booked')
                                    <span style="color: red; font-weight: bold;">{{ $car->status }}</span>
                                    @else
                                    {{ $car->status }}
                                    @endif
                                </p>
                                <!-- Tambahkan elemen HTML atau Bootstrap yang sesuai untuk menampilkan informasi lainnya -->
                            </div>
                        </div>
                        @endforeach
                    </div>





                </div>

                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Rental Mobilku 2023</span>
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
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        <a class="btn btn-primary" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            Logout
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('tampilan/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('tampilan/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{[asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('js/sb-admin-2.min.js')}}"></script>

        <!-- Page level plugins -->
        <script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>


</body>

</html>