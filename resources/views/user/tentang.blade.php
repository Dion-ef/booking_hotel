<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
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
                <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="/index">Pama Hotel</a></div>
                <div class="col-6 col-lg-8">

                    <!-- <button class="btn-login">Login</button> -->
                    <div class="site-menu-toggle js-site-menu-toggle" data-aos="fade">

                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <!-- END menu-toggle -->

                    <div class="site-navbar js-site-navbar">
                        <nav role="navigation">
                            <div class="container">
                                <div class="row full-height align-items-center">
                                    <div class="col-md-6 mx-auto">
                                        <ul class="list-unstyled menu">
                                        @guest
                                            <li class=""><a href="/login">Login</a></li>
                                            <li><a href="/index">Home</a></li>
                                            <li><a href="/room">Room</a></li>
                                            <li class="active"><a href="/tentang">Tentang</a></li>
                                            <li><a href="/kontak">Kontak</a></li>
                                            <li><a href="/reservasi">Reservasi</a></li>
                                            @endguest
                                            @auth
                                            <li class=""><a href="/logout">Logout</a></li>
                                            <li><a href="/user/index">Home</a></li>
                                            <li><a href="/user/room">Room</a></li>
                                            <li class="active"><a href="/user/tentang">Tentang</a></li>
                                            <li><a href="/user/kontak">Kontak</a></li>
                                            <li><a href="/user/reservasi">Reservasi</a></li>
                                            <li><a href="/user/riwayat">Riwayat</a></li>
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


    <section class="site-hero inner-page overlay" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade">
                    <h1 class="heading mb-3">Tentang</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/index">Home</a></li>
                        <li>&bullet;</li>
                        <li>About</li>
                    </ul>
                </div>
            </div>
        </div>

        <a class="mouse smoothscroll" href="#next">
            <div class="mouse-icon">
                <span class="mouse-wheel"></span>
            </div>
        </a>
    </section>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
                    <figure class="img-absolute">
                        <img src="{{asset('assets/css/images/image_6.jpg')}}" alt="Image" class="img-fluid">
                    </figure>
                    <img src="{{asset('assets/css/images/img_1.jpg')}}" alt="Image" class="img-fluid rounded">
                </div>
                <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
                    <h2 class="heading">Welcome!</h2>
                    <p class="mb-4">Selamat datang di Pama Hotel! Terletak di lokasi yang menakjubkan, jauh dari hiruk-pikuk kota, kami menawarkan pengalaman menginap yang tenang dan menyenangkan. Nikmati kenyamanan dan keindahan alam yang menyatu di Pama Hotel, tempat di mana kemewahan bertemu dengan ketenangan. Dengan fasilitas modern dan layanan prima, kami siap menyambut Anda untuk sebuah pengalaman menginap yang tak terlupakan. Jelajahi keindahan alam sekitar dan nikmati pelayanan terbaik hanya di Pama Hotel!.</p>

                </div>

            </div>
        </div>
    </section>


    <div class="container section">

        <div class="row justify-content-center text-center mb-5">
            <div class="col-md-7 mb-5">
                <h2 class="heading" data-aos="fade-up">Leadership</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="block-2">
                    <div class="flipper">
                        <div class="front" style="background-image: url(images/person_3.jpg);">
                            <div class="box">
                                <h2>Will Peters</h2>
                                <p>President</p>
                            </div>
                        </div>
                        <div class="back">
                            <!-- back content -->
                            <blockquote>
                                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                            </blockquote>
                            <div class="author d-flex">
                                <div class="image mr-3 align-self-center">
                                    <img src="images/person_3.jpg" alt="">
                                </div>
                                <div class="name align-self-center">Will Peters <span class="position">President</span></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .flip-container -->
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="block-2"> <!-- .hover -->
                    <div class="flipper">
                        <div class="front" style="background-image: url(css/images/person_1.jpg);">
                            <div class="box">
                                <h2>Jane Williams</h2>
                                <p>Business Manager</p>
                            </div>
                        </div>
                        <div class="back">
                            <!-- back content -->
                            <blockquote>
                                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                            </blockquote>
                            <div class="author d-flex">
                                <div class="image mr-3 align-self-center">
                                    <img src="images/person_1.jpg" alt="">
                                </div>
                                <div class="name align-self-center">Jane Williams <span class="position">Business Manager</span></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .flip-container -->
            </div>

            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="block-2">
                    <div class="flipper">
                        <div class="front" style="background-image: url(images/person_2.jpg);">
                            <div class="box">
                                <h2>Jeffrey Neddery</h2>
                                <p>Marketing Director</p>
                            </div>
                        </div>
                        <div class="back">
                            <!-- back content -->
                            <blockquote>
                                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                            </blockquote>
                            <div class="author d-flex">
                                <div class="image mr-3 align-self-center">
                                    <img src="images/person_2.jpg" alt="">
                                </div>
                                <div class="name align-self-center">Jeffrey Neddery <span class="position">Marketing Director</span></div>
                            </div>
                        </div>
                    </div>
                </div> <!-- .flip-container -->
            </div>
        </div>
    </div>

    <section class="section slider-section bg-light">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">Foto</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                        @foreach($getgambar as $gambar)
                        <div class="slider-item">
                            <img src="{{ asset('storage/' . $gambar->gambar) }}" alt="Image placeholder" class="img-fixed">
                        </div>
                        @endforeach
                    </div>
                    <!-- END slider -->
                </div>

            </div>
        </div>
    </section>



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
    </section>

    <footer class="section footer-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-3 mb-5">
                    <ul class="list-unstyled link">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Rooms</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5">
                    <ul class="list-unstyled link">
                        <li><a href="#">The Rooms &amp; Suites</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Restaurant</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5 pr-md-5 contact-info">
                    <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
                    <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> 198 West 21th Street, <br> Suite 721 New York NY 10016</span></p>
                    <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+1) 435 3533</span></p>
                    <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> info@domain.com</span></p>
                </div>
                <div class="col-md-3 mb-5">
                    <p>Sign up for our newsletter</p>
                    <form action="#" class="footer-newsletter">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email...">
                            <button type="submit" class="btn"><span class="fa fa-paper-plane"></span></button>
                        </div>
                    </form>
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


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>