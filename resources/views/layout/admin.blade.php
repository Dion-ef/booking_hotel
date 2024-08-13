<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pama Hotel</title>
    <!-- lokal -->
    <link href="{{asset('assets/admin/css/styleku.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{asset('font/css/all.min.css')}}" rel="stylesheet">
    

    <!-- datatables -->
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">


    <!-- multiple select -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" rel="stylesheet">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="body">
    
    <div id="app" class="d-flex">
        <div class="d-flex flex-column flex-shrink-0 p-3 px-4 text-white sticky-top sidebar-container">
            <a href="" class="sidebar-text-header">
                <p class="">Pama Hotel</p>
            </a>

            <p class="side-name">{{ Auth::user()->name }}</p>
            <p class="side-email">{{ Auth::user()->email }}</p>

            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <p>Master</p>
                </li>
                <li class="sidebar-menu">
                    <div class="nav-link">
                        <a href="/dashboard/admin"><i class="fa-solid fa-home sidebar-icon" aria-hidden="true"></i></a>
                        <a class="side-menu" href="/dashboard/admin"> Home</a>
                    </div>
                </li>
                <li class="sidebar-menu">
                    <div class="nav-link  ">
                        <a href="/kamar/admin"><i class="fa-solid fa-store sidebar-icon"></i></a>
                        <a class="side-menu" href="/kamar/admin"> Kamar</a>
                    </div>
                </li>
                <li class="sidebar-menu">
                    <div class="nav-link  ">
                        <a href="/kategori/admin"><i class="fa-solid fa-cart-shopping sidebar-icon" aria-hidden="true"></i></a>
                        <a class="side-menu" href="/kategori/admin"> Kategori</a>
                    </div>
                </li>
                <li class="sidebar-menu">
                    <div class="nav-link  ">
                        <a href="/kategori/admin"><i class="fa-solid fa-building sidebar-icon" aria-hidden="true"></i></a>
                        <a class="side-menu" href="/fasilitas/admin"> Fasilitas</a>
                    </div>
                </li>

                <li>
                    <p>Transaction</p>
                </li>
                <li class="sidebar-menu">
                    <div class="nav-link  ">
                        <a href="/dashboard/admin"><i class="fa-solid fa-folder-open sidebar-icon" aria-hidden="true"></i></a>
                        <a class="side-menu" href="/booking/admin"> Booking</a>
                    </div>
                </li>


                <li class="sidebar-menu">
                    <div class="nav-link  ">
                        <a href="/riwayat/admin"><i class="fa-solid fa-clone sidebar-icon" aria-hidden="true"></i></a>
                        <a class="side-menu" href="/riwayat/admin">Riwayat</a>
                    </div>

                </li>
                <li class="sidebar-menu">
                    <div class="nav-link  ">
                        <a href="/logout"><i class="fa-solid fa-circle-left sidebar-icon" aria-hidden="true"></i></a>
                        <a class="side-menu" href="/logout"> Keluar</a>
                    </div>
                </li>
            </ul>
            <hr>

        </div>
        <div class="main-wrapper">
            <div class="nav-navbar" id="navbar">

                <a id="bars"><i class="fa-solid fa-bars nav-bars"></i></a>


                <!-- <form class="search" role="search" action="" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form> -->

                <div class="dropdown pb-4 profil-dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none  name" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('assets/css/images/person_1.jpg')}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                        <span class="d-none d-sm-inline mx-1">{{ Auth::user()->name }}</span>
                    </a>

                    <div class="dropdown-center">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none message" data-bs-toggle="dropdown" aria-expanded="false">
                            <!-- <img src="{{asset('gambar/user.jfif')}}" alt="hugenerd" width="30" height="30" class="rounded-circle"> -->
                            <span class="d-none d-sm-inline mx-1"><i class="fa-solid fa-envelope"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start shadow mt-3">
                            <form class="px-4 py-3">
                                <div class="mb-3">
                                    <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                        <label class="form-check-label" for="dropdownCheck">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </form>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">New around here? Sign up</a>
                            <a class="dropdown-item" href="#">Forgot password?</a>
                        </div>
                    </div>

                    <ul class="dropdown-menu dropdown-menu-light text-small shadow mt-3">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-user sidebar-icon"></i> Edit Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/logout"><i class="fa-solid fa-circle-left sidebar-icon"></i> Keluar</a></li>
                    </ul>
                </div>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profil</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form role="form" method="POST" action="/update/profil">
                                    @csrf
                                    <div class="card p-img" style="width: 200px; height: 200px;">
                                        <a href="/dashboard/admin">
                                            <img src="{{asset('assets/css/images/person_1.jpg')}}" class="card-img-top p-img" alt="/dashboard">
                                        </a>
                                    </div>
                                    <div class="form">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="name" name="name" class="form-control" value="{{ Auth::user()->name }}">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>



            </div>
            @yield('konten')
        </div>




    </div>
    
    @include('sweetalert::alert')





    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    

    <script src="{{asset('assets/admin/js/styleku.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        window.Echo.channel('booking-notif')
            .listen('NotifikasiBooking', (e) => {
            Swal.fire({
                title: 'Booking Notification',
                text: `${e.bookingData.nama} telah memesan kamar ${e.bookingData.kamar} dari ${e.bookingData.checkin} sampai ${e.bookingData.checkout}`,
                icon: 'info',
                confirmButtonText: 'OK'
            });
            });
    </script>
    @yield('script')
</body>

</html>

</html>