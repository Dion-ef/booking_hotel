@extends('layout.user')

@section('konten')
<section class="site-hero overlay" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row site-hero-inner justify-content-center align-items-center">
                <div class="col-md-10 text-center" data-aos="">
                    <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To | Pama Hotel</span>
                    <h1 class="heading">Riwayat</h1>
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
                <div class="block-32 table-responsive" data-aos="fade-up" data-aos-offset="-200">

                    @if($data->count())
                    <table class="table table-striped" data-aos="fade-up">
                        <thead>
                            <tr>
                                <th><strong>Nama Kamar</strong></th>
                                <th><strong>Tanggal Check-in</strong></th>
                                <th><strong>Tanggal Check-out</strong></th>
                                <th><strong>Jumlah Orang</strong></th>
                                <th><strong>Total</strong></th>
                                <th><strong>Status</strong></th>
                                <th><strong>Aksi</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{ $item->kamar->nama }}</td>
                                <td>{{ $item->in }}</td>
                                <td>{{ $item->out }}</td>
                                <td>{{ $item->jumlah_orang }}</td>
                                <td>Rp.{{ number_format($item->total) }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    @if($item->status == 'unpaid')
                                    <a href="" class="btn btn-info btn-sm" data-aos="fade-up">Bayar Sekarang</a>
                                    @endif
                                    <a href="" class="btn btn-warning btn-sm" data-aos="fade-up">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Paginate -->
                    <div class="d-flex justify-content-center">
                        {{ $data->links() }}
                    </div>
                    @else
                    <div class="alert alert-warning">
                        Anda belum memiliki riwayat pemesanan.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endSection