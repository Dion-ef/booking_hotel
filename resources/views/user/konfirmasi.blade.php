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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>

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
                    <h1 class="heading">Invoice</h1>
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

    <section class="section bg-light pb-0" data-aos="">
        <div class="container">

            <div class="check-availabilty" id="next">

                <div class="container invoice">
                    <div class="invoice-header">
                        <div class="row">
                            <div class="col-xs-8">
                                <h1>Invoice</h1>
                                <h4 class="text-muted"> | Date: {{$pemesanan->tgl_pemesanan}}</h4>
                            </div>
                            <div class="col-xs-4">
                                <div class="media">
                                    <div class="media-left">
                                        <img class="media-object logo" src="https://dummyimage.com/70x70/000/fff&text=ACME" />
                                    </div>
                                    <ul class="media-body list-unstyled">
                                        <li><strong>Pama Hotel</strong></li>
                                        <li>Jl. Panglima Sudirman Gg. 8 No.16, Kepatihan, <br>Kec.Tulungagung, Kabupaten Tulungagung<br>Telepon: 0123-456789</li>
                                        <li>pama01@gmail.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-body">
                        <div class="row">
                            <div class="col-xs-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Detail Pemesan</h3>
                                    </div>
                                    <div class="panel-body text-start">
                                        <dl class="dl-inline">
                                            <dt class="">Nama</dt>
                                            <dd>{{$pemesanan->nama}}</dd>
                                            <dt>Email</dt>
                                            <dd>{{$pemesanan->email}}</dd>
                                            <dt>Phone</dt>
                                            <dd>{{$pemesanan->phone}}</dd>
                                            <dt>&nbsp;</dt>
                                            <dd>&nbsp;</dd>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Detail Pesanan</h3>
                            </div>
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>
                                            <dt>Kode Pesanan</dt>
                                        </th>
                                        <th>
                                            <dt>Kamar</dt>
                                        </th>
                                        <th class="text-center colfix">
                                            <dt>Check In</dt>
                                        </th>
                                        <th class="text-center colfix">
                                            <dt>Check Out</dt>
                                        </th>
                                        <th class="text-center colfix">
                                            <dt>Jumlah Orang</dt>
                                        </th>
                                        <th class="text-center colfix">
                                            <dt>Harga Per Malam</dt>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{$pemesanan->kode}}
                                        </td>
                                        <td>
                                            {{$pemesanan->kamar->nama}}
                                        </td>
                                        <td class="text-right">
                                            {{$pemesanan->in}}
                                        </td>
                                        <td class="text-right">
                                            {{$pemesanan->out}}
                                        </td>
                                        <td class="text-right">
                                            {{$pemesanan->jumlah_orang}}
                                        </td>
                                        <td class="text-right">
                                            Rp. {{number_format($pemesanan->harga)}}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="panel panel-default">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <td class="text-center col-xs-1">
                                            <dt>Total</dt>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th class="text-center rowtotal mono">Rp. {{number_format($pemesanan -> total)}}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xs-7">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <i>Comments / Notes</i>
                                        <hr style="margin:3px 0 5px" />Terima kasih telah memilih hotel kami. Kami berharap Anda menikmati masa menginap Anda. Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi resepsionis. Selamat berlibur!
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Metode Pembayaran</h3>
                                    </div>
                                    <div class="panel-body">
                                        <p>Untuk kenyamanan Anda, Anda dapat melakukan pembayaran di salah satu bank kami.</p>
                                        <ul class="list-unstyled">
                                            <img src="{{asset('assets/css/images/bni.png')}}" alt="" class="logo-bank">
                                            <img src="{{asset('assets/css/images/bri.png')}}" alt="" class="logo-bank">
                                            <img src="{{asset('assets/css/images/bca.png')}}" alt="" class="logo-bank">
                                            <img src="{{asset('assets/css/images/permata.png')}}" alt="" class="logo-bank">
                                        </ul>
                                    </div>
                                </div>
                                <div class="invoice-footer text-center mt-4">
                                    <a href="{{ url('user/index') }}" class="btn btn-warning">Kembali ke Beranda</a>
                                    <a href="{{ url('user/index') }}" class="btn btn-primary">Bayar Sekarang</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="invoice-footer">
                        Terima Kasih

                        <strong>~Have a Nice Day~</strong>
                    </div>
                </div>

                <!-- Invoice 1 - Bootstrap Brain Component -->

                <!-- <div class="card card-invoice">
                    <div class="row justify-content-center mt-5">
                        <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
                            <div class="row gy-3 mb-3">
                                <div class="col-6">
                                    <h2 class="text-uppercase text-endx m-0">Invoice</h2>
                                </div>
                                <div class="col-6">
                                    <a class="d-block text-end" href="#!">
                                        <img src="./assets/img/bsb-logo.svg" class="img-fluid" alt="BootstrapBrain Logo" width="135" height="44">
                                    </a>
                                </div>
                                <div class="col-12">
                                    <h4>From</h4>
                                    <address>
                                        <strong>Pama Hotel</strong><br>
                                        Jl. Panglima Sudirman Gg. 8 No.16, Kepatihan, <br>Kec.Tulungagung, Kabupaten Tulungagung<br>Telepon: 0123-456789 <br>
                                        Email: pama01@gmail.com
                                    </address>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-sm-6 col-md-8">
                                    <h4>Kepada</h4>
                                    <address>
                                        <strong>{{$pemesanan->nama}}</strong><br>
                                        Phone: {{$pemesanan->phone}}<br>
                                        Email: {{$pemesanan->email}}
                                    </address>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h4 class="row">
                                        <span class="col-6">Invoice </span>

                                    </h4>
                                    <div class="row">
                                        <span class="col-6">Date</span>
                                        <span class="col-6 text-sm-end">{{$pemesanan->tgl_pemesanan}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-uppercase">Kode</th>
                                                    <th scope="col" class="text-uppercase">Kamar</th>
                                                    <th scope="col" class="text-uppercase text-end">Jumlah Orang</th>
                                                    <th scope="col" class="text-uppercase text-end">Harga Permalam</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr>
                                                    <th scope="row">{{$pemesanan->kode}}</th>
                                                    <td>{{$pemesanan->kamar->nama}}</td>
                                                    <td class="text-end">{{$pemesanan->jumlah_orang}}</td>
                                                    <td class="text-end">Rp. {{number_format($pemesanan->harga)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th scope="col-12" class="text-uppercase">Total</th>
                                                    <th scope="col" class="text-uppercase "><Strong>Rp. {{number_format($pemesanan->total)}}</Strong></th>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                                <p>Untuk kenyamanan Anda, Anda dapat melakukan pembayaran di salah satu bank kami.</p>
                                <ul class="list-unstyled">
                                    <img src="{{asset('assets/css/images/bni.png')}}" alt="" class="logo-bank">
                                    <img src="{{asset('assets/css/images/bri.png')}}" alt="" class="logo-bank">
                                    <img src="{{asset('assets/css/images/bca.png')}}" alt="" class="logo-bank">
                                    <img src="{{asset('assets/css/images/permata.png')}}" alt="" class="logo-bank">
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-12 text-end mb-5">
                                    <a href="{{ url('user/index') }}" class="btn btn-warning">Kembali ke Beranda</a>
                                    <a href="{{ url('user/index') }}" class="btn btn-primary">Bayar Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div </div> -->
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


    <script src="{{asset('assets/js/aos.js')}}"></script>

    <script src="{{asset('assets/js/bootstrap-datepicker.js')}}"></script>
    <script src="{{asset('assets/js/jquery.timepicker.min.js')}}"></script>



    <script src="{{asset('assets/js/main.js')}}"></script>


    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
</body>

</html>