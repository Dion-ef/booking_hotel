<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('assets/admin/css/styleku.css')}}" rel="stylesheet">
    <link href="{{asset('font/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Pama Hotel</title>

    <style>
        @foreach($asset as $item)
        .site-hero-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('storage/' . $item->background_img) }}');
            background-repeat: no-repeat;
            background-size: cover;
            filter: brightness(50%);
            z-index: -1;
        }
        @endforeach
    </style>

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
                    <!-- END menu-toggle -->

                    <div class="site-navbar js-site-navbar">
                        <nav role="navigation">
                            <div class="container">
                                <div class="row full-height align-items-center">
                                    <div class="col-md-6 mx-auto">
                                        <ul class="list-unstyled menu">
                                            <li class="active"><a href="/login">Login</a></li>
                                            <li class=""><a href="/index">Home</a></li>
                                            <li><a href="/room">Room</a></li>
                                            <li><a href="/tentang">Tentang</a></li>
                                            <li><a href="/kontak">Kontak</a></li>
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


    <div class="site-hero-login">
        <div class="container-login">
            <div class="row  justify-content-center align-items-center">
                <div class="border border-register ">
                    <div class="container-l">
                        <div class="login-header">
                            <center>LOGIN</center>
                        </div>
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $item)
                                <li>{{$item}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form role="form" method="POST" action="/user/validasi">
                            @csrf
                            <div class="form">
                                <label class="form-label">Email</label>
                                <input name="email" class="form-control" placeholder="Masukkan Email" value="{{Session::get('email')}}">

                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Password">
                                <div class="pilih-login text-center">
                                    <p>--atau login cepat menggunakan--</p>
                                </div>
                                <div class="pilih-container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="icon-container">
                                                <a href="{{route('google.redirect')}}"><img src="{{asset('assets/css/images/g.png')}}" alt=""></a>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-6">
                                            <div class="icon-container">
                                                <a href=""><img src="{{asset('assets/css/images/f.webp')}}" alt=""></a>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>



                                <button class="btn btn-dark r-btn" name="submit" type="submit">Login</button>



                                <div class="signup text-center">
                                    <p>Belum punya akun? <a href="/register"> Buat Disini</a></p>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>