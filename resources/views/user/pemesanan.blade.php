@extends('layout.user')

@section('konten')
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

    <section id="pemesanan-form" class="section bg-light pb-0">
        <div class="container">

            <div class="row check-availabilty" id="next">
                <div class="block-32" data-aos="" data-aos-offset="-200">
                    @foreach($user as $m)

                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-md-6 form-group">
                            <form action="/user/pesan/{{$m->id}}" method="POST" class="bg-white p-md-5 p-4 mb-5 border">
                                @csrf
                                @error('kategori_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
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
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <input type="submit" name="submit" value="Check In Sekarang" class="btn btn-primary text-white py-3 px-5 font-weight-bold">
                                    </div>
                                </div>

                            </form>

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
                                        
                                        @endforeach
                                        @endif
                                    </div>
                                </div>




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




                    </div>
                </div>

                @endforeach
            </div>





        </div>
        </div>
    </section>
@endSection