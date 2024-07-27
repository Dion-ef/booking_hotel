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
                      <li><a href="/tentang">Tentang</a></li>
                      <li><a href="/kontak">Kontak</a></li>
                      <li class="active"><a href="/reservasi">Reservasi</a></li>
                      @endguest
                      @auth
                      <li class=""><a href="/logout">Logout</a></li>
                      <li><a href="/user/index">Home</a></li>
                      <li><a href="/user/room">Room</a></li>
                      <li><a href="/user/tentang">Tentang</a></li>
                      <li><a href="/user/kontak">Kontak</a></li>
                      <li class="active"><a href="/user/reservasi">Reservasi</a></li>
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

  <section class="site-hero inner-page overlay" data-stellar-background-ratio="0.5">
    <div class="container">
      <div class="row site-hero-inner justify-content-center align-items-center">
        <div class="col-md-10 text-center" data-aos="fade">
          <h1 class="heading mb-3">Form Reservasi</h1>
          <ul class="custom-breadcrumbs mb-4">
            <li><a href="/index">Home</a></li>
            <li>&bullet;</li>
            <li>Reservasi</li>
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

  <section class="section contact-section" id="next">
    <div class="container">
      <div class="row">
        <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">

          <form action="#" method="post" class="bg-white p-md-5 p-4 mb-5 border">
            <div class="row">
              <div class="col-md-6 form-group">
                <label class="text-black font-weight-bold" for="name">Name</label>
                <input type="text" id="name" class="form-control ">
              </div>
              <div class="col-md-6 form-group">
                <label class="text-black font-weight-bold" for="phone">Phone</label>
                <input type="text" id="phone" class="form-control ">
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 form-group">
                <label class="text-black font-weight-bold" for="email">Email</label>
                <input type="email" id="email" class="form-control ">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                <label class="text-black font-weight-bold" for="checkin_date">Date Check In</label>
                <input type="text" id="checkin_date" class="form-control">
              </div>
              <div class="col-md-6 form-group">
                <label class="text-black font-weight-bold" for="checkout_date">Date Check Out</label>
                <input type="text" id="checkout_date" class="form-control">
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 form-group">
                <label for="adults" class="font-weight-bold text-black">Jumlah Orang</label>
                <div class="field-icon-wrap">
                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                  <select name="" id="adults" class="form-control">
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4+</option>
                  </select>
                </div>
              </div>
            </div>



            <div class="row mb-4">
              <div class="col-md-12 form-group">
                <label class="text-black font-weight-bold" for="message">Notes</label>
                <textarea name="message" id="message" class="form-control " cols="30" rows="8"></textarea>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="submit" value="Reserve Now" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
              </div>
            </div>
          </form>

        </div>
        <div class="col-md-5" data-aos="fade-up" data-aos-delay="200">
          <div class="row">
            <div class="col-md-10 ml-auto contact-info">
              <p><span class="d-block">Address:</span> <span class="text-black"> Jl. Panglima Sudirman Gg. 8 No.16, Kepatihan, <br>Kec.Tulungagung, Kabupaten Tulungagung</span></p>
              <p><span class="d-block">Phone:</span> <span class="text-black"> (+1) 435 3533</span></p>
              <p><span class="d-block">Email:</span> <span class="text-black"> info@yourdomain.com</span></p>
            </div>
          </div>
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