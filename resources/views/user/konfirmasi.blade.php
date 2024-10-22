@extends('layout.user')

@section('link')
<link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
@endSection

@section('konten')
<section class="site-hero overlay" data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="">
                <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To | Pama Hotel</span>
                <h1 class="heading">Invoice</h1>
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

            <div class="container invoice">
                <div class="invoice-header">
                    <div class="row">
                        <div class="col-xs-8">
                            <h1>Invoice</h1>
                            <h4 class="text-muted"> | Date: {{$pemesanan->tgl_pemesanan}}</h4>
                        </div>
                        <div class="col-xs-4">
                            <div class="media">
                                <div class="media-left">
                                    <!-- diisi img logo belga -->
                                    @foreach($asset as $item)
                                    <img class="media-object logo" src="{{ asset('storage/' . $item->logo) }}" />
                                    @endforeach
                                </div>
                                <ul class="media-body list-unstyled">
                                    @foreach($asset as $item)
                                    <li><strong>{{$item->nama_hotel}}</strong></li>
                                    <li>{{$item->alamat}}</li>
                                    <li>{{$item->email}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice-body">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Detail Pemesan</h3>
                                </div>
                                <div class="panel-body text-start">
                                    <dl class="dl-inline">
                                        <dt class="">Nama</dt>
                                        <dd>{{$pemesanan->nama}}</dd>
                                        <dt>Email</dt>
                                        <dd>{{$pemesanan->email}}</dd>
                                        <dt>Phone</dt>
                                        <dd>{{$pemesanan->phone}}</dd>
                                        <dt>&nbsp;</dt>
                                        <dd>&nbsp;</dd>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Detail Pesanan</h3>
                        </div>
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <th>
                                        <dt>Kode Pesanan</dt>
                                    </th>
                                    <th>
                                        <dt>Kamar</dt>
                                    </th>
                                    <th class="text-center colfix">
                                        <dt>Check In</dt>
                                    </th>
                                    <th class="text-center colfix">
                                        <dt>Check Out</dt>
                                    </th>
                                    <th class="text-center colfix">
                                        <dt>Jumlah Orang</dt>
                                    </th>
                                    <th class="text-center colfix">
                                        <dt>Harga Per Malam</dt>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        {{$pemesanan->kode}}
                                    </td>
                                    <td>
                                        {{$pemesanan->kamar->nama}}
                                    </td>
                                    <td class="text-right">
                                        {{$pemesanan->in}}
                                    </td>
                                    <td class="text-right">
                                        {{$pemesanan->out}}
                                    </td>
                                    <td class="text-right">
                                        {{$pemesanan->jumlah_orang}}
                                    </td>
                                    <td class="text-right">
                                        Rp. {{number_format($pemesanan->harga)}}
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="panel panel-default">
                        <table class="table table-bordered table-condensed">
                            <thead>
                                <tr>
                                    <td class="text-center col-xs-1">
                                        <dt>Total</dt>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-center rowtotal mono">Rp. {{number_format($pemesanan -> total)}}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <i>Comments / Notes</i>
                                    <hr style="margin:3px 0 5px" />Terima kasih telah memilih hotel kami. Kami berharap Anda menikmati masa menginap Anda. Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk menghubungi resepsionis. Selamat berlibur!
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Metode Pembayaran</h3>
                                </div>
                                <div class="panel-body">
                                    <p>Untuk kenyamanan Anda, Anda dapat melakukan pembayaran di salah satu bank kami.</p>
                                    <ul class="list-unstyled">
                                        <img src="{{asset('images/bni.png')}}" alt="" class="logo-bank">
                                        <img src="{{asset('images/bri.png')}}" alt="" class="logo-bank">
                                        <img src="{{asset('images/bca.png')}}" alt="" class="logo-bank">
                                        <img src="{{asset('images/permata.png')}}" alt="" class="logo-bank">
                                    </ul>
                                </div>
                            </div>
                            <div class="invoice-footer text-center mt-4">
                                <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
                                <a href="{{ url('user/index') }}" class="btn btn-warning">Kembali ke Beranda</a>
                                <form action="/payment" method="POST" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="pemesanan_id" value="{{ $pemesanan->id }}">
                                    <button type="submit" class="btn btn-primary">Bayar Sekarang</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="invoice-footer">
                    Terima Kasih

                    <strong>~Have a Nice Day~</strong>
                </div>
            </div>
        </div>
</section>
@endSection