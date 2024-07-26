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


                    <div class="site-navbar js-site-navbar">
                        <nav role="navigation">
                            <div class="container">
                                <div class="row full-height align-items-center">
                                    <div class="col-md-6 mx-auto">
                                        <ul class="list-unstyled menu">
                                            @guest
                                            <li class=""><a href="/login">Login</a></li>
                                            <li class="active"><a href="/index">Home</a></li>
                                            <li><a href="/room">Room</a></li>
                                            <li><a href="/tentang">Tentang</a></li>
                                            <li><a href="/kontak">Kontak</a></li>
                                            <li><a href="/reservasi">Reservasi</a></li>
                                            @endguest
                                            @auth
                                            <li class=""><a href="/logout">Logout</a></li>
                                            <li class="active"><a href="/user/index">Home</a></li>
                                            <li><a href="/user/room">Room</a></li>
                                            <li><a href="/user/tentang">Tentang</a></li>
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
    <!-- END head -->


    <section class="site-hero overlay" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="fade-up">
                    <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To | Pama Hotel</span>
                    <h1 class="heading">Tempat Terbaik Untuk Tinggal Bersama Keluarga Anda</h1>
                </div>
            </div>
        </div>

        <a class="mouse smoothscroll" href="#next">
            <div class="mouse-icon">
                <span class="mouse-wheel"></span>
            </div>
        </a>
    </section>
    <!-- END section -->

    <section class="section bg-light pb-0">
        <div class="container">
            <div class="row check-availabilty" id="next">
                <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                    <form action="{{ route('cek-ketersediaan') }}" method="GET">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                                <div class="field-icon-wrap">
                                    <div class="icon"><span class="icon-calendar"></span></div>
                                    <input type="text" id="checkin_date" name="checkin_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                                <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                                <div class="field-icon-wrap">
                                    <div class="icon"><span class="icon-calendar"></span></div>
                                    <input type="text" id="checkout_date" name="checkout_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                                <div class="row">
                                    <div class="col-md-6 mb-3 mb-md-0">
                                        <label for="jumlah_orang" class="font-weight-bold text-black">Jumlah Orang</label>
                                        <div class="field-icon-wrap">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select name="jumlah_orang" id="jumlah_orang" class="form-control" required>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 align-self-end">
                                <button class="btn btn-primary btn-block text-white" type="submit">Cek Ketersediaan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                    <p class="mb-4 text-justify">Selamat datang di Pama Hotel! Terletak di lokasi yang menakjubkan, jauh dari hiruk-pikuk kota, kami menawarkan pengalaman menginap yang tenang dan menyenangkan. Nikmati kenyamanan dan keindahan alam yang menyatu di Pama Hotel, tempat di mana kemewahan bertemu dengan ketenangan. Dengan fasilitas modern dan layanan prima, kami siap menyambut Anda untuk sebuah pengalaman menginap yang tak terlupakan. Jelajahi keindahan alam sekitar dan nikmati pelayanan terbaik hanya di Pama Hotel!.</p>

                </div>

            </div>
        </div>
    </section>

    @guest
    <section class="section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">Rooms</h2>
                </div>
            </div>

            <div class="row">
                @foreach($kategori as $m)
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <a href="/user/pemesanan/{{$m->id}}" class="room">
                        <figure class="img-wrap">
                            <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                                @if (isset($gambar[$m->id]))
                                @foreach($gambar[$m->id] as $img)
                                <div class="slider-item">
                                    <img src="{{ asset('storage/' . $img->gambar) }}" alt="Gambar Kategori" class="fixed-height-img">
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </figure>
                        <div class="p-3 text-center room-info">
                            <h2>{{$m->nama}}</h2>
                            <span class="text-uppercase letter-spacing-1">Rp. {{number_format($m->harga)}} / per malam</span>
                        </div>
                    </a>
                </div>
                @endforeach


            </div>
        </div>
    </section>
    @endguest

    @auth
    <section class="section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">Rooms</h2>
                </div>
            </div>

            <div class="row">
                @foreach($kategori as $m)
                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                    <a href="/user/pemesanan/{{$m->id}}" class="room">
                        <figure class="img-wrap">
                            <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                                @if (isset($gambar[$m->id]))
                                @foreach($gambar[$m->id] as $img)
                                <div class="slider-item">
                                    <img src="{{ asset('storage/' . $img->gambar) }}" alt="Gambar Kategori" class="fixed-height-img">
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </figure>
                        <div class="p-3 text-center room-info">
                            <h2>{{$m->nama}}</h2>
                            <span class="text-uppercase letter-spacing-1">Rp. {{number_format($m->harga)}} / per malam</span>
                        </div>
                    </a>
                </div>
                @endforeach


            </div>
        </div>
    </section>


    @endauth




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
    <!-- END section -->

    <!-- END section -->
    <section class="section testimonial-section">
        <div class="container">
            <div class="row justify-content-center text-center mb-5">
                <div class="col-md-7">
                    <h2 class="heading" data-aos="fade-up">People Says</h2>
                </div>
            </div>
            <div class="row">
                <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; Jean Smith</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>


                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; Jean Smith</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>
                            <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>

                    <div class="testimonial text-center slider-item">
                        <div class="author-image mb-3">
                            <img src="images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
                        </div>
                        <blockquote>

                            <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
                        </blockquote>
                        <p><em>&mdash; John Doe</em></p>
                    </div>

                </div>
                <!-- END slider -->
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