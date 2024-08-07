@extends('layout.user')

@section('konten')
<section class="site-hero overlay" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="">
                    <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To | Pama Hotel</span>
                    <h1 class="heading">Ketersediaan Kamar</h1>
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
                <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

                    <p><strong>Pencarian :</strong></p>
                    <p><strong>Check In: </strong>{{ $checkinDate->format('d-m-Y') }}</p>
                    <p><strong>Check Out: </strong>{{ $checkoutDate->format('d-m-Y') }}</p>
                    <p><strong>Jumlah Orang: </strong>{{ $jumlahOrang }}</p>

                    @if($kamarTersedia->isEmpty())
                    <div class="alert alert-warning">
                        Tidak ada kamar yang tersedia untuk tanggal dan jumlah orang yang dipilih
                    </div>
                    @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nama Kamar</th>
                                <th>Kapasitas</th>
                                <th>Harga / malam</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kamarTersedia as $kamar)
                            <tr>
                                <td>{{ $kamar->nama }}</td>
                                <td>{{ $kamar->kapasitas }}</td>
                                <td>Rp. {{ number_format($kamar->kategori->harga) }}</td>
                                <td><a href="/user/pemesanan/kamar/{{$kamar->id}}" class="btn btn-primary">Pesan</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endSection