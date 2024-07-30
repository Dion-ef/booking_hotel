<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/styleku.css')}}" rel="stylesheet">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                                            <li><a href="/tentang">Tentang</a></li>
                                            <li><a href="/kontak">Kontak</a></li>
                                            <li><a href="/reservasi">Reservasi</a></li>
                                            @endguest
                                            @auth
                                            <li class=""><a href="/logout">Logout</a></li>
                                            <li><a href="/user/index">Home</a></li>
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
                <div class="col-md-10 text-center" data-aos="">
                    <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To | Pama Hotel</span>
                    <h1 class="heading">Form Pemesanan</h1>
                    <ul class="custom-breadcrumbs mb-4">
                        <li><a href="/index">Home</a></li>
                        <li>&bullet;</li>
                        <li>Pemesanan</li>
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
    <!-- END section -->

    <section class="section bg-light pb-0">
        <div class="container">

            <div class="row check-availabilty" id="next">
                <div class="block-32" data-aos="" data-aos-offset="-200">
                    @foreach($user as $m)

                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-md-6 form-group">
                            <form action="/user/pesan/{{$m->id}}" method="POST" class="bg-white p-md-5 p-4 mb-5 border">
                                @csrf
                                <div>
                                    <label class="text-black font-weight-bold" for="name">Name</label>
                                    <input type="text" id="nama" name="nama" class="form-control mb-3" value="{{$m->name}}">
                                    @error('nama')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label class="text-black font-weight-bold" for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control mb-3" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-black font-weight-bold" for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control mb-3" value="{{$m->email}}">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-black font-weight-bold" for="checkin_date">Date Check In</label>
                                    <input type="text" id="checkin_date" name="Checkin" class="form-control" value="{{ old('Checkin') }}">
                                    <div class="info">
                                        <p><strong>Check-In Time:</strong> 14:00 WIB</p>
                                    </div>
                                    @error('Checkin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label class="text-black font-weight-bold" for="checkout_date">Date Check Out</label>
                                    <input type="text" id="checkout_date" name="Checkout" class="form-control" value="{{ old('Checkout') }}">
                                    <div class="info">
                                        <p><strong>Check-Out Time:</strong> 12:00 WIB</p>
                                    </div>
                                    @error('Checkout')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="adults" class="font-weight-bold text-black">Jumlah Orang</label>
                                    <select name="jumlah_orang" id="adults" class="form-control mb-3">
                                        <option value="1" {{ old('jumlah_orang') == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ old('jumlah_orang') == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ old('jumlah_orang') == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ old('jumlah_orang') == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ old('jumlah_orang') == 5 ? 'selected' : '' }}>5</option>
                                    </select>
                                    @error('jumlah_orang')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div>
                                    <label for="kamarSelect" class="font-weight-bold text-black">Pilih Kamar</label>
                                    <select name="kamar_id" id="kamarSelect" class="form-control mb-3">
                                        <option value="" selected>Pilih Kamar Yang Tersedia</option>
                                        @foreach($kamar as $item)
                                        <option value="{{ $item->id }}" {{ old('kamar_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }} ( {{ $item->kapasitas }} orang )
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('kamar_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-6" data-aos="fade-down">
                            <div class="room">

                                <div class="pemesanan-container">
                                    <div class="home-sliders major-carousel owl-carousel mb-5" data-aos="fade-down" data-aos-delay="100">
                                        @if (isset($gambar[$data->id]))
                                        @foreach($gambar[$data->id] as $img)
                                        <div class="slider-item">
                                            <img src="{{ asset('storage/' . $img->gambar) }}" alt="Gambar Kategori" class="fixed-height-img-pemesanan">
                                        </div>
                                        <!-- <div class="owl-nav">
                                            <button class="owl-prev"><i class="fa fa-arrow-left"></i></button>
                                            <button class="owl-next"><i class="fa fa-arrow-right"></i></button>
                                        </div> -->
                                        @endforeach
                                        @endif
                                    </div>
                                </div>


                                <!-- <div class="pemesanan-container">
                                    <div class="home-sliders major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                                        @if (isset($gambar[$m->id]))
                                        @foreach($gambar[$m->id] as $img)
                                        <div class="slider-item">
                                            <img src="{{ asset('storage/' . $img->gambar) }}" alt="Gambar Kategori" class="fixed-height-img-pemesanan">
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div> -->


                                <div class="p-3 text-center room-info">
                                    <h2>{{ $data->nama }}</h2>
                                    <span class="text-uppercase letter-spacing-1">Rp. {{ number_format($data->harga) }} / per malam</span>
                                </div>
                            </div>
                            </br>
                            <h5>Fasilitas:</h5>
                            <ul>

                                @foreach($data->fasilitas as $fasilitas)
                                <li class="fasilitas">{{ $fasilitas->nama }}</li>
                                @endforeach
                            </ul>
                        </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="submit" name="submit" value="Check In Sekarang" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                                    </div>
                                </div>

                            </form>
                        </div>


                       

                    </div>
                </div>

                @endforeach
            </div>





        </div>
        </div>
    </section>



    <footer class="section footer-section">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-5 mb-5">
                    <ul class="list-unstyled link">
                        <li><a href="/user/room">The Rooms &amp; Suites</a></li>
                        <li><a href="/user/tentang">About Us</a></li>
                        <li><a href="/user/kontak">Contact Us</a></li>
                        <li><a href="/user/reservasi">Reservation</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-5 pr-md-5 contact-info">
                    <!-- <li>198 West 21th Street, <br> Suite 721 New York NY 10016</li> -->
                    <p><span class="d-block"><span class="ion-ios-location h5 mr-3 text-primary"></span>Address:</span> <span> 198 West 21th Street, <br> Suite 721 New York NY 10016</span></p>
                    <p><span class="d-block"><span class="ion-ios-telephone h5 mr-3 text-primary"></span>Phone:</span> <span> (+1) 435 3533</span></p>
                    <p><span class="d-block"><span class="ion-ios-email h5 mr-3 text-primary"></span>Email:</span> <span> info@domain.com</span></p>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="{{asset('assets/js/aos.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>
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



    <script src="{{asset('assets/js/main.js')}}"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>