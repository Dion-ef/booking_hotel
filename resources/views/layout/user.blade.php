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

    <link rel="stylesheet" href="{{asset('fonts/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('fonts/fontawesome/css/font-awesome.min.css')}}">
    <title>Pama Hotel</title>
</head>
<body>
    
<header class="site-header js-site-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                @foreach($asset as $item)
                <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="/index">{{$item->nama_hotel}}</a></div>
                @endforeach
                <div class="col-6 col-lg-8">

                    <!-- <button class="btn-login">Login</button> -->
                    <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">

                        <span></span>
                        <span></span>
                        <span></span>
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


    <!-- 
    <section class="section bg-image overlay" style="background-image: url('images/hero_4.jpg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
                    <h2 class="text-white font-weight-bold">Tempat Terbaik Untuk Tinggal Bersama Keluarga Anda. Reservasi Sekarang!</h2>
                </div>
                <div class="col-12 col-md-6 text-center text-md-right" data-aos="fade-up" data-aos-delay="200">
                    <a href="/user/reservasi" class="btn btn-outline-white-primary py-3 text-white px-5">Reservasi Sekarang</a>
                </div>
            </div>
        </div>
    </section> -->
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
                    <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
                    <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> {{$item->alamat}}</span></p>
                    <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> {{$item->phone}}</span></p>
                    <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> {{$item->email}}</span></p>
                    @endforeach
                </div>
            </div>
            <div class="row pt-5">
                <!-- <p class="col-md-6 text-left">
                    Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0.
                    Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                    Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. 
                </p> -->

                <p class="col-md-6 text-right social">
                    <a href="#"><span class="fa fa-facebook"></span></a>
                    <a href="#"><span class="fa fa-twitter"></span></a>
                    <a href="#"><span class="fa fa-linkedin"></span></a>
                </p>
            </div>
        </div>
    </footer>


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