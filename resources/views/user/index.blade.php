@extends('layout.user')


@section('konten')

<section class="site-hero overlay" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade-up">
                <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To | Pama Hotel</span>
                @foreach($asset as $item)
                <h1 class="heading">{{$item->headline}}</h1>
                @endforeach
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


@guest
<section class="section bg-light pb-0">
    <div class="container">
        <div class="row check-availabilty" id="next">
            <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                <form action="{{ route('cek-ketersediaan-guest') }}" method="GET">
                    @csrf
                    <div class="row">
                        <?php
                        $today = date('d-m-Y');
                        ?>
                        <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                            <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                            <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>

                                <input type="text" id="checkin_date" name="checkin_date" class="form-control" required value="<?php echo $today; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                            <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                            <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>
                                <input type="text" id="checkout_date" name="checkout_date" class="form-control" required value="<?php echo $today; ?>">
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
@endguest

@auth
<section class="section bg-light pb-0">
    <div class="container">
        <div class="row check-availabilty" id="next">
            <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                <form action="{{ route('cek-ketersediaan') }}" method="GET">
                    @csrf
                    <div class="row">
                        <?php
                        $today = date('d-m-Y');
                        ?>
                        <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                            <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                            <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>

                                <input type="text" id="checkin_date" name="checkin_date" class="form-control" required value="<?php echo $today; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                            <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                            <div class="field-icon-wrap">
                                <div class="icon"><span class="icon-calendar"></span></div>
                                <input type="text" id="checkout_date" name="checkout_date" class="form-control" required value="<?php echo $today; ?>">
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
@endauth


<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
                <!-- <figure class="img-absolute">
                        <img src="{{asset('assets/css/images/image_6.jpg')}}" alt="Image" class="img-fluid">
                    </figure> -->
                @foreach($asset as $item)
                <img src="{{ asset('storage/' . $item->welcome_img) }}" alt="Image" class="img-fluid rounded">
                @endforeach
            </div>
            <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
                <h2 class="heading">Welcome!</h2>
                @foreach($asset as $item)
                <p class="mb-4 text-justify">{{$item->deskripsi}}</p>
                @endforeach
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
                <a href="/user/guest/detail/{{$m->id}}#detail-form" class="room">
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
                <a href="/user/detail/{{$m->id}}#detail-form" class="room">
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
@endSection