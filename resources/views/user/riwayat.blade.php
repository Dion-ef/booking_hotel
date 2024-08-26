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
            <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

                @if($data->count())
                <table class="table table-striped table-responsive" data-aos="fade-up">
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
                        @foreach($data as $pemesanan)
                        <tr>
                            <td>{{ $pemesanan->kamar->nama }}</td>
                            <td>{{ $pemesanan->in }}</td>
                            <td>{{ $pemesanan->out }}</td>
                            <td>{{ $pemesanan->jumlah_orang }}</td>
                            <td>Rp.{{ number_format($pemesanan->total) }}</td>
                            <td>{{ $pemesanan->status }}</td>
                            <td>
                                @if($pemesanan->status == 'unpaid')
                                <form action="/payment" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
                                    <button type="submit" class="btn btn-warning">Bayar Sekarang</button>
                                </form>
                                @endif
                                <a class="btn btn-info btn-sm btn-action" data-aos="fade-up" data-bs-toggle="modal" data-bs-target="#detail{{$pemesanan->id}}">Detail</a>
                                <!-- dilakukan pengecekan apakah user yang user_idnya sudah melakukan review pada kamar tertentu atau belum jika sudah maka tombol tidak akan ditampilkan dan juga sebaliknya -->
                                <!-- exists digunakan untuk mengecek apakah ada review yang sudah dibuat user tersebut yang cocok dari query tersebut, jika ada maka hasilnya tru dan sebaliknya -->
                                @if(!$pemesanan->kamar->reviews()->where('users_id', Auth::user()->id)->exists())
                                <a class="btn btn-danger btn-sm btn-action" data-aos="fade-up" data-bs-toggle="modal" data-bs-target="#review{{$pemesanan->id}}">Review</a>
                                @endif

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
                    <div class="card">
                        <div class="card-body">
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

                            <div class="check-container">
                                <div class="checkin-container text-center">
                                    <p>Check-In</p>
                                    {{$item->in}}
                                </div>
                                <div class="selisih-hari">
                                    {{$item->selisih_hari}} Hari
                                </div>
                                <div class="checkin-container text-center">
                                    <p>Check-Out</p>
                                    {{$item->out}}
                                </div>
                            </div>

                            <div class="kamar-detail">
                                <h1>Kamar {{$item->kamar->nama}}</h1>
                                <p><i class="fa-regular fa-user"></i> {{$item->jumlah_orang}} orang</p>
                                <p><i class="fa-regular fa-window-maximize"></i> {{$item->kategori->nama}}</p>
                            </div>

                            <div class="kode-pesanan">
                                <p>Kode Booking</p>
                                <p>{{$item->kode}}</p>
                            </div>
                            <div class="tgl-pesanan">
                                <p>Tanggal Pemesanan</p>
                                <p>{{$item->tgl_pemesanan}}</p>
                            </div>
                            <div class="kode-pesanan">
                                <p>Status</p>
                                <p class="text-danger">{{$item->status}}</p>
                            </div>

                            <div class="total-price">
                                <p><i class="fa-regular fa-newspaper"></i> Total Price</p>
                                <h1>Rp. {{number_format($item->total)}}</h1>
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


@foreach($data as $item)
<div class="modal fade" id="review{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kamar_id" value="{{ $item->kamar->id }}">

                    <div class="form-group">
                        <label for="review">Review:</label>
                        <textarea name="review" id="review" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <div class="rating">
                            @for ($i = 5; $i
                            >= 1; $i--)
                                <input type="radio" name="rating" value="{{ $i }}" id="rating{{ $item->id }}-{{ $i }}" />
                            <label for="rating{{ $item->id }}-{{ $i }}">★</label>
                            @endfor
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>


            </div>

        </div>
    </div>
</div>

@endforeach




@endSection