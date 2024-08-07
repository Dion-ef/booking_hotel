@extends('layout.user')

@section('konten')
<!-- style="  background-image: url(/assets/css/images/hero_4.jpg);" -->
<section class="site-hero overlay" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="">
                <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To | Pama Hotel</span>
                <h1 class="heading">Detail Kamar</h1>
                <ul class="custom-breadcrumbs mb-4">
                    <li><a href="/index">Home</a></li>
                    <li>&bullet;</li>
                    <li>Detail</li>
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

<section id="detail-form" class="section bg-light pb-0" style="padding-top: 100px;">
    <div class="container">

        <div class="row check-availabilty" id="next">
            <div class="block-32" data-aos="fade-up" data-aos-offset="-200">
                <div class="row">
                    <div class="col-md-6">
                        <div class="room">

                            <div class="pemesanan-container">
                                <div class="home-sliders major-carousel owl-carousel mb-5" data-aos="fade-down" data-aos-delay="100">
                                    @if (isset($gambar[$data->id]))
                                    @foreach($gambar[$data->id] as $img)
                                    <div class="slider-item">
                                        <img src="{{ asset('storage/' . $img->gambar) }}" alt="Gambar Kategori" class="fixed-height-img-pemesanan">
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>




                            <div class="p-3 text-center room-info">
                                <h2>{{ $data->nama }}</h2>
                                <span class="text-capitalize letter-spacing-1">Rp. {{ number_format($data->harga) }} / per malam</span>
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

                    <div class="col-md-6">
                        <div class="container">
                            <p style="color: #000;">Kamar yang tersedia :</p>
                            @if (isset($kamars[$data->id]) && $kamars[$data->id]->isNotEmpty())
                            <div class="kamar-container">
                                @foreach ($kamars[$data->id] as $kamar)
                                <div class="kamar-card">
                                    <p class="text-center">{{ $kamar->nama }}</p>
                                </div>

                                @endforeach
                            </div>
                            @else
                            <p style="color: #000;">Tidak ada kamar kosong di kategori ini.</p>
                            @endif
                        </div>
                        <div class="container mt-4">
                            <h5>Deskripsi:</h5>
                            <p class="text-justify text-deskripsi-user">{{$data->deskripsi}}</p>
                            @if ($errors->has('deskripsi'))
                            <span class="text-danger">{{ $errors->first('deskripsi') }}</span>
                            @endif
                        </div>
                        <div class="container mt-5">
                            <a href="/user/pemesanan/{{$data->id}}#pemesanan-form" class="bbtn btn-primary text-white py-3 px-5 font-weight-bold"> Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endSection