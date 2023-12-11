<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User | Driver List</title>

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

        @include('layouts.navbar-user')

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
                        action="{{ route('sewaDriver', ['idCar' => session('sessionIdCar')]) }}" method="GET">
                        <div class="input-group">
                            <input type="number" class="form-control bg-light border-0 small"
                                placeholder="Input Pengalaman Kerja Yang Ingin Dicari" aria-label="Search"
                                aria-describedby="basic-addon2" name="search">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Formulir Filter -->
                    <form class="form-inline mb-2"
                        action="{{ route('sewaDriver', ['idCar' => session('sessionIdCar')]) }}" method="GET">
                        <div class="form-group mr-2">
                            <label for="genderFilter">Filter Jenis Kelamin :</label>
                            <select class="form-control" id="genderFilter" name="gender">
                                <option value="">Semua</option>
                                <option value="Laki-Laki" {{ request('gender')=='Laki-Laki' ? 'selected' : '' }}>
                                    Laki-Laki</option>
                                <option value="Perempuan" {{ request('gender')=='Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
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



                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->username
                                    }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('tampilan/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            @include('layouts.profileUser')
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800" style="margin-left: 50px;">Driver List</h1>

                        <!-- Tombol Sewa Tanpa Driver -->
                        @if(session('sewaMobil'))
                        <a href="{{ route('viewFormPenyewaanWithSim', ['idCar' => session('sessionIdCar')]) }}"
                            class="btn btn-warning">Sewa Tanpa Driver</a>
                        @endif
                    </div>

                    <div class="container mt-8">
                        <div class="row">
                            @foreach($drivers as $driver)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Informasi Driver -->
                                        <h5 class="card-title">{{ $driver->nama }}</h5>
                                        <p class="card-text"><strong>Jenis Kelamin:</strong> {{ $driver->gender }}</p>
                                        <p class="card-text"><strong>Nomor Telepon:</strong> {{ $driver->no_telp }}</p>
                                        <p class="card-text"><strong>Pengalaman Kerja:</strong> {{
                                            $driver->pengalaman_kerja }} tahun</p>
                                        <p class="card-text"><strong>Status:</strong>
                                            @if($driver->status == 'Available')
                                            <span style="color: #00ff30; font-weight: bold;">{{ $driver->status
                                                }}</span>
                                            @elseif($driver->status == 'Booked')
                                            <span style="color: red; font-weight: bold;">{{ $driver->status }}</span>
                                            @else
                                            {{ $driver->status }}
                                            @endif
                                        </p>
                                        <!-- Tombol Sewa Driver -->
                                        @if(session('sewaMobil') )
                                        <!-- Tampilkan tombol "Sewa Driver" -->
                                        <!-- Tambahkan pengecekan status untuk menonaktifkan tombol "Sewa Mobil" -->
                                        @if($driver->status != 'Booked')
                                        <a href="{{ route('viewFormPenyewaanNoSim', ['idCar' => session('sessionIdCar'),'idDriver' => $driver->id]) }}"
                                            class="btn btn-success">Sewa Driver</a>
                                        @else
                                        <button class="btn btn-secondary" disabled>Tidak Tersedia</button>
                                        @endif

                                        @else
                                        <!-- Tampilkan pesan atau aksi jika mobil belum dipilih -->
                                        <p>Anda harus memilih mobil terlebih dahulu.</p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
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