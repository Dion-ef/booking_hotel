@extends('layout.user')

@section('konten')
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


<div class="container section">

    <div class="row justify-content-center text-center mb-5">
        <div class="col-md-7 mb-5">
            <h2 class="heading" data-aos="fade-up">Leadership</h2>
        </div>
    </div>

    <div class="row">
        @foreach($leadership as $item)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="block-2">
                <div class="flipper">
                    <div class="front" id="front-{{ $item->id }}">
                        <div class="box">
                            <h2>{{$item->nama}}</h2>
                            <p>{{$item->jabatan}}</p>
                        </div>
                    </div>
                    <div class="back" id="back-{{ $item->id }}">
                        <p>{{$item->motivasi}}</p>
                        <div class="author d-flex">
                            <div class="image mr-3 align-self-center">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="">
                            </div>
                            <div class="name align-self-center">{{$item->nama}} <span class="position">{{$item->jabatan}}</span></div>
                        </div>
                    </div>
                </div>
            </div> <!-- .flip-container -->
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var frontElement = document.getElementById('front-{{ $item->id }}');
                if (frontElement) {
                    frontElement.style.backgroundImage = "url('{{ asset('storage/' . $item->gambar) }}')";
                }

                var backElement = document.getElementById('back-{{ $item->id }}');
                if (backElement) {
                    backElement.style.backgroundImage = "url('{{ asset('storage/' . $item->gambar) }}')";
                }
            });
        </script>
        @endforeach

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




@endSection