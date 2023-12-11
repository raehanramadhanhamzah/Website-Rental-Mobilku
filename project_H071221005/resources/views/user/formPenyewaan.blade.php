<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User</title>

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
                            @include('layouts.profileUser')
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Car Rental Form</h1>
                    </div>
                    <!-- Car Details -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">Car Details</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>ID Mobil:</strong> {{ $cars->id }}</li>
                                        <li class="list-group-item"><strong>Merk Mobil:</strong> {{ $cars->merk }}</li>
                                        <li class="list-group-item"><strong>Model Mobil:</strong> {{ $cars->model }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Gambar Mobil:</strong>
                                            <br>
                                            <img src="{{ asset('storage/'.$cars->gambar_path) }}" alt="Car Image"
                                                width="300" height="200">
                                        </li>
                                    </ul>

                                    <!-- Driver Details -->
                                    @if(session('onlyKTP') )
                                    <h5 class="card-title mt-4">Driver Details</h5>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><strong>ID Driver:</strong> {{$drivers->id }}</li>
                                        <li class="list-group-item"><strong>Nama Driver:</strong> {{$drivers->nama}}</li>
                                    </ul>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Rental Form -->
                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Rental Information</h5>
                                    <!-- jika user milih pakai driver makan routenya ke formPenyewaan1 -->
                                    <form
                                        action="{{ route('formPenyewaan', ['idCar' => session('sessionIdCar'),'idDriver' => session('sessionIdDriver')]) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="nama">Nama:</label>
                                            <input type="text" class="form-control" id="nama" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="no_telp">Nomor Telepon:</label>
                                            <input type="number" class="form-control" id="no_telp" name="no_telp"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="durasi_rental">Durasi Rental (Maksimal 14 hari):</label>
                                            <input type="number" class="form-control" id="durasi_rental"
                                                name="durasi_rental" min="1" max="14" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto_ktp">Upload Foto KTP:</label>
                                            <input type="file" class="form-control-file" id="foto_ktp" name="foto_ktp"
                                                accept="image/*" required>
                                        </div>
                                        @if(session('withSim'))
                                        <div class="form-group">
                                            <label for="foto_sim">Upload Foto SIM:</label>
                                            <input type="file" class="form-control-file" id="foto_sim" name="foto_sim"
                                                accept="image/*" required>
                                        </div>
                                        @endif
                                        <input type="hidden" name="akun_user" value="{{ Auth::user()->username }}">
                                        <input type="hidden" name="id_mobil" value="{{ session('sessionIdCar') }}">
                                        <input type="hidden" name="id_driver" value="{{ session('sessionIdDriver') }}">
                                        <!-- Add more hidden fields for driver and other details if needed -->
                                        <button type="submit" class="btn btn-primary">Submit Rental</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

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