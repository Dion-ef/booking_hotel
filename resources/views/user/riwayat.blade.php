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
                            <th class="col-md-4"><strong>Aksi</strong></th>
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
                                <a href="" class="btn btn-warning btn-sm" data-aos="fade-up">Bayar Sekarang</a>
                                @endif
                                <a class="btn btn-info btn-sm btn-action" data-aos="fade-up" data-bs-toggle="modal" data-bs-target="#detail{{$item->id}}">Detail</a>
                                <a class="btn btn-danger btn-sm btn-action" data-aos="fade-up">Review</a>
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

@foreach($data as $item)
<div class="modal fade" id="detail{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <div class="container-booking">
                    <h1 class="text-center">Riwayat Pemesanan</h1>
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col text-center">
                                    <h3>Pama Hotel</h3>
                                    <p class="text-align-center">Jl. Panglima Sudirman Gg. 8 No.16, Kepatihan, <br>Kec.Tulungagung, Kabupaten Tulungagung<br>Telepon: 0123-456789</p>
                                </div>
                            </div>
                            <div class="room">

                                <div class="pemesanan-container">
                                    <div class="home-sliders major-carousel owl-carousel mb-5" data-aos="fade-down" data-aos-delay="100">
                                        @if (isset($gambar[$item->id]))
                                        @foreach($gambar[$item->id] as $img)
                                        <div class="slider-item">
                                            <img src="{{ asset('storage/' . $img->gambar) }}" alt="Gambar Kategori" class="fixed-height-img-pemesanan">
                                        </div>
                                        
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <h5>Informasi Pemesan</h5>
                                    <p><strong>Nama:</strong> {{ $item->nama }}</p>
                                    <p><strong>Email:</strong> {{ $item->email }}</p>
                                    <p><strong>Telepon:</strong> {{ $item->phone }}</p>
                                </div>
                                <div class="col">
                                    <h5>Informasi Pesanan</h5>
                                    <p><strong>Kode Pemesanan: {{$item->kode}}</strong> </p>
                                    <p><strong>Tanggal Pemesanan:</strong> {{ $item->tgl_pemesanan }}</p>
                                    <p><strong>Status:</strong> {{ $item->status }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <h5>Detail Kamar</h5>
                                    <p><strong>Kategori Kamar:</strong> {{ $item->kategori->nama }}</p>
                                    <p><strong>Nomor Kamar:</strong> {{ $item->kamar->nama }}</p>
                                    <p><strong>Jumlah Orang:</strong> {{ $item->jumlah_orang }}</p>
                                </div>
                                <div class="col">
                                    <h5>Durasi Menginap</h5>
                                    <p><strong>Check-in:</strong> {{ $item->in }}</p>
                                    <p><strong>Check-out:</strong> {{ $item->out }}</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <h5>Rincian Biaya</h5>
                                    <p><strong>Total Biaya:</strong> Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <!-- <button class="btn btn-primary" onclick="window.print()">Print Nota</button> -->
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            </div>

                        </div>
                    </div>
                </div>



            </div>

        </div>
    </div>
</div>
@endforeach

@endSection