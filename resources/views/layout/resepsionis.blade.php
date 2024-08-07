<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pama Hotel</title>

    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/css/vendor.bundle.base.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet">


    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">


    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{asset('font/css/all.min.css')}}" rel="stylesheet">

    <!-- datatables -->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
    @foreach($asset as $item) 
        .navbar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('storage/' . $item->background_img) }}') center center no-repeat;
            background-size: cover;
            filter: brightness(50%);
            z-index: -1;
        }
        @endforeach
    </style>
    @yield('link')
</head>

<body>

    <div class="container-scroller d-flex">
        <div class="rw p-0 m-0 proBanner " id="proBanner">

            <!-- partial:./partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas d-flex flex-column flex-shrink-0" id="sidebar">
                <!-- <div class="header-text">
                    <span>Pama Hotel</span>
                </div> -->

                <ul class="nav">
                    <!-- <hr style="border: 1px solid white; width: 100%; margin: 20px auto;"> -->
                    <li class="nav-item sidebar-category">
                        <p>Navigation</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/dashboard/resepsionis') ? 'active' : '' }}" href="/dashboard/resepsionis">
                            <i class="mdi mdi-view-quilt menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item sidebar-category">
                        <p>Components</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/resepsionis/kamar') ? 'active' : '' }}" href="/resepsionis/kamar">
                            <i class="mdi mdi-bank menu-icon"></i>
                            <span class="menu-title">Kamar</span>
                        </a>
                    </li>
                    <li class="nav-item sidebar-category">
                        <p>Transaction</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/resepsionis/booking') ? 'active' : '' }}" href="/resepsionis/booking">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Booking</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/resepsionis/riwayat') ? 'active' : '' }}" href="/resepsionis/riwayat">
                            <i class="mdi mdi-archive menu-icon"></i>
                            <span class="menu-title">Riwayat</span>
                        </a>
                    </li>
                    <li class="nav-item sidebar-category">
                        <p>Keluar</p>
                        <span></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="mdi mdi-logout menu-icon"></i>
                            <span class="menu-title">Keluar</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->



            <div class="container-fluid page-body-wrapper">
                <!-- partial:./partials/_navbar.html -->
                <nav class="navbar col-lg-12 col-12 px-0 py-0 py-lg-4 d-flex flex-row img-f" style="background-color: #fff; width: 100%; margin-left: 120px;">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-menu"></span>
                        </button>
                        <div class="navbar-brand-wrapper">

                        </div>

                        <h4 class="font-weight-bold mb-0 d-none d-md-block mt-1 m-3">Welcome back, {{ Auth::guard('admin')->user()->name }}</h4>


                        <!-- <a class="mouse-admin smoothscroll">
                            <div class="mouse-icon-admin">
                                <span class="mouse-wheel-admin"></span>
                            </div>
                        </a> -->
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item">
                                <h4 <h4 id="dateRange" class="mb-0 font-weight-bold d-none d-xl-block"></h4>
                            </li>

                            <li class="nav-item dropdown me-2">
                                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                                    <i class="mdi mdi-email-open mx-0"></i>
                                    <span class="count bg-danger">1</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-success">
                                                <i class="mdi mdi-information mx-0"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                            <p class="font-weight-light small-text mb-0 text-muted">
                                                Just now
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-warning">
                                                <i class="mdi mdi-settings mx-0"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">Settings</h6>
                                            <p class="font-weight-light small-text mb-0 text-muted">
                                                Private message
                                            </p>
                                        </div>
                                    </a>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-info">
                                                <i class="mdi mdi-account-box mx-0"></i>
                                            </div>
                                        </div>
                                        <div class="preview-item-content">
                                            <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                            <p class="font-weight-light small-text mb-0 text-muted">
                                                2 days ago
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                    <div class="navbar-menu-wrapper navbar-search-wrapper d-none d-lg-flex align-items-center">
                        <!-- <ul class="navbar-nav mr-lg-2">
                            <li class="nav-item nav-search d-none d-lg-block">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search Here..." aria-label="search" aria-describedby="search">
                                </div>
                            </li>
                        </ul> -->
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item nav-profile dropdown">

                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown">
                                    <!-- <img src="images/faces/face5.jpg" alt="profile" /> -->
                                    <span class="nav-profile-name">{{ Auth::guard('admin')->user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                    <!-- <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="mdi mdi-settings text-primary"></i>
                                        Update Profil
                                    </a> -->
                                    <a class="dropdown-item" href="/logout">
                                        <i class="mdi mdi-logout text-primary"></i>
                                        Logout
                                    </a>
                                </div>





                            </li>
                            <!-- <li class="nav-item">
                                <a href="#" class="nav-link icon-link">
                                    <i class="mdi mdi-plus-circle-outline"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link icon-link">
                                    <i class="mdi mdi-web"></i>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link icon-link">
                                    <i class="mdi mdi-clock-outline"></i>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </nav>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('konten')
                        <!-- row end -->
                    </div>

                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>


            <!-- page-body-wrapper ends -->
        </div>
    </div>

    <!-- container-scroller -->
    <!-- vendor -->
    <script src="{{asset('assets/admin/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('assets/admin/vendors/chart.js/Chart.min.js')}}"></script>
    
    <!-- main js -->
    <script src="{{asset('assets/admin/js/master/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/master/off-canvas.js')}}"></script>
    <script src="{{asset('assets/admin/js/master/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/admin/js/master/template.js')}}"></script>
    <script src="{{asset('assets/admin/js/master/dashboard.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <!-- End custom js for this page-->
    <script src="{{ mix('js/app.js') }}"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    @include('sweetalert::alert')


    <!-- untuk menampilkan tgl dan jam pada navbar -->
    <script>
        // Fungsi untuk memformat tanggal menjadi format "MMM DD, YYYY HH:MM AM/PM"
        function formatDateTime(date) {
            const options = {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            };
            const formattedDate = date.toLocaleDateString('en-US', options);

            let hours = date.getHours();
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // Jam 0 harus jadi 12
            const formattedTime = `${hours}:${minutes} ${ampm}`;

            return `${formattedDate} ${formattedTime}`;
        }

        // Fungsi untuk mengatur tanggal dan jam saat ini
        function setCurrentDateTime() {
            const now = new Date();
            const formattedDateTime = formatDateTime(now);

            const dateRangeElement = document.getElementById('dateRange');
            dateRangeElement.textContent = formattedDateTime;
        }

        document.addEventListener('DOMContentLoaded', function() {
            setCurrentDateTime();
            // 1000 milisecond atau 1 detik
            setInterval(setCurrentDateTime, 1000);
        });
    </script>

    <!-- untuk membuat ketika di klik gambar akan membuaka pemilihan file pada edit profil -->
    <script>
        function handleFileSelect(event) {
            var file = event.target.files[0];
            if (file) {
                console.log("File selected: " + file.name);
            }
        }
    </script>

    <!-- untuk menambahkan class active pada nav-link -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const menuItems = document.querySelectorAll('.nav-link');

            menuItems.forEach((item) => {
                const href = item.getAttribute('href');
                if (currentPath.startsWith(href)) {
                    item.classList.add('active');
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>