<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('assets/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/fancybox.min.css')}}">
    <link href="{{asset('font/css/all.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/fontawesome/css/font-awesome.min.css')}}">

    @yield('link')
    <title>Pama Hotel</title>
</head>
<body>
    
<header class="site-header js-site-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                @foreach($asset as $item)
                <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="/index">{{$item->nama_hotel}}</a></div>
                @endforeach
                <!-- <div class="col-lg-4 text-center">
                    <p>MMM</p>
                </div> -->
                <div class="col-6 col-lg-8">

                    <!-- <button class="btn-login">Login</button> -->
                    <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">
                        <i class="fa fa-bars"></i>
                    </div>
                    


                    <div class="site-navbar js-site-navbar">
                        <nav role="navigation">
                            <div class="container">
                                <div class="row full-height align-items-center">
                                    <div class="col-md-6 mx-auto">
                                        <ul class="list-unstyled menu">
                                            @guest
                                            <li><a class="{{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a></li>
                                            <li><a class="{{ Request::is('index') ? 'active' : '' }}" href="/index">Home</a></li>
                                            <li><a class="{{ Request::is('room') ? 'active' : '' }}" href="/room">Room</a></li>
                                            <li><a class="{{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang</a></li>
                                            <li><a class="{{ Request::is('kontak') ? 'active' : '' }}" href="/kontak">Kontak</a></li>
                                            @endguest
                                            @auth
                                            <li><a class="{{ Request::is('logout') ? 'active' : '' }}" href="/logout">Logout</a></li>
                                            <li><a class="{{ Request::is('user/index') ? 'active' : '' }}" href="/user/index">Home</a></li>
                                            <li><a class="{{ Request::is('user/room') ? 'active' : '' }}" href="/user/room">Room</a></li>
                                            <li><a class="{{ Request::is('user/tentang') ? 'active' : '' }}" href="/user/tentang">Tentang</a></li>
                                            <li><a class="{{ Request::is('user/kontak') ? 'active' : '' }}" href="/user/kontak">Kontak</a></li>
                                            <li><a class="{{ Request::is('user/riwayat') ? 'active' : '' }}" href="/user/riwayat">Riwayat</a></li>
                                            @endauth
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('konten')


    <footer class="section footer-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-5 mb-5">
                    <ul class="list-unstyled link">
                        <li><a href="/user/room">The Rooms &amp; Suites</a></li>
                        <li><a href="/user/tentang">About Us</a></li>
                        <li><a href="/user/kontak">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5 pr-md-5 contact-info">
                    @foreach($asset as $item)
                    <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> {{$item->alamat}}</span></p>
                    <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> {{$item->phone}}</span></p>
                    <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> {{$item->email}}</span></p>
                    @endforeach
                </div>
            </div>
            <div class="row pt-5">

            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-migrate-3.0.1.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('assets/js/aos.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- script untuk backgorund dinamis -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var background = document.querySelector('.site-hero');
            if(background) {
                background.style.backgroundImage = "url('{{ asset('storage/' . $item->background_img) }}')";
            }
        });
    </script>
    <!-- script untuk sliders detail dan form pemesanan -->
     <script>
        $(document).ready(function() {
            $('.home-sliders').owlCarousel({
                loop: true, // Loop kembali ke gambar pertama setelah gambar terakhir
                margin: 10,
                nav: true,
                navText: ['<i class="fa fa-arrow-left"></i>', '<i class="fa fa-arrow-right"></i>'],
                items: 1,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true
            });
        });
    </script>
    
    <!-- js untuk scroll langsung ke section yang dipilih -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek jika ada hash di URL
            if (window.location.hash) {
                var targetSection = document.querySelector(window.location.hash);
                if (targetSection) {
                    // Smooth scrolling
                    targetSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    </script>
    @yield('script')
</body>
</html>