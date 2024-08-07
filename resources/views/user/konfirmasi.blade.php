@extends('layout.user')

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
                                        <img class="media-object logo" src="https://dummyimage.com/70x70/000/fff&text=ACME" />
                                    </div>
                                    <ul class="media-body list-unstyled">
                                        <li><strong>Pama Hotel</strong></li>
                                        <li>Jl. Panglima Sudirman Gg. 8 No.16, Kepatihan, <br>Kec.Tulungagung, Kabupaten Tulungagung<br>Telepon: 0123-456789</li>
                                        <li>pama01@gmail.com</li>
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
                                            <img src="{{asset('assets/css/images/bni.png')}}" alt="" class="logo-bank">
                                            <img src="{{asset('assets/css/images/bri.png')}}" alt="" class="logo-bank">
                                            <img src="{{asset('assets/css/images/bca.png')}}" alt="" class="logo-bank">
                                            <img src="{{asset('assets/css/images/permata.png')}}" alt="" class="logo-bank">
                                        </ul>
                                    </div>
                                </div>
                                <div class="invoice-footer text-center mt-4">
                                    <a href="{{ url('user/index') }}" class="btn btn-warning">Kembali ke Beranda</a>
                                    <a href="{{ url('user/index') }}" class="btn btn-primary">Bayar Sekarang</a>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="invoice-footer">
                        Terima Kasih

                        <strong>~Have a Nice Day~</strong>
                    </div>
                </div>

                <!-- Invoice 1 - Bootstrap Brain Component -->

                <!-- <div class="card card-invoice">
                    <div class="row justify-content-center mt-5">
                        <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
                            <div class="row gy-3 mb-3">
                                <div class="col-6">
                                    <h2 class="text-uppercase text-endx m-0">Invoice</h2>
                                </div>
                                <div class="col-6">
                                    <a class="d-block text-end" href="#!">
                                        <img src="./assets/img/bsb-logo.svg" class="img-fluid" alt="BootstrapBrain Logo" width="135" height="44">
                                    </a>
                                </div>
                                <div class="col-12">
                                    <h4>From</h4>
                                    <address>
                                        <strong>Pama Hotel</strong><br>
                                        Jl. Panglima Sudirman Gg. 8 No.16, Kepatihan, <br>Kec.Tulungagung, Kabupaten Tulungagung<br>Telepon: 0123-456789 <br>
                                        Email: pama01@gmail.com
                                    </address>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-sm-6 col-md-8">
                                    <h4>Kepada</h4>
                                    <address>
                                        <strong>{{$pemesanan->nama}}</strong><br>
                                        Phone: {{$pemesanan->phone}}<br>
                                        Email: {{$pemesanan->email}}
                                    </address>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <h4 class="row">
                                        <span class="col-6">Invoice </span>

                                    </h4>
                                    <div class="row">
                                        <span class="col-6">Date</span>
                                        <span class="col-6 text-sm-end">{{$pemesanan->tgl_pemesanan}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-uppercase">Kode</th>
                                                    <th scope="col" class="text-uppercase">Kamar</th>
                                                    <th scope="col" class="text-uppercase text-end">Jumlah Orang</th>
                                                    <th scope="col" class="text-uppercase text-end">Harga Permalam</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-group-divider">
                                                <tr>
                                                    <th scope="row">{{$pemesanan->kode}}</th>
                                                    <td>{{$pemesanan->kamar->nama}}</td>
                                                    <td class="text-end">{{$pemesanan->jumlah_orang}}</td>
                                                    <td class="text-end">Rp. {{number_format($pemesanan->harga)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <th scope="col-12" class="text-uppercase">Total</th>
                                                    <th scope="col" class="text-uppercase "><Strong>Rp. {{number_format($pemesanan->total)}}</Strong></th>
                                                </tr>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                                <p>Untuk kenyamanan Anda, Anda dapat melakukan pembayaran di salah satu bank kami.</p>
                                <ul class="list-unstyled">
                                    <img src="{{asset('assets/css/images/bni.png')}}" alt="" class="logo-bank">
                                    <img src="{{asset('assets/css/images/bri.png')}}" alt="" class="logo-bank">
                                    <img src="{{asset('assets/css/images/bca.png')}}" alt="" class="logo-bank">
                                    <img src="{{asset('assets/css/images/permata.png')}}" alt="" class="logo-bank">
                                </ul>
                            </div>
                            <div class="row">
                                <div class="col-12 text-end mb-5">
                                    <a href="{{ url('user/index') }}" class="btn btn-warning">Kembali ke Beranda</a>
                                    <a href="{{ url('user/index') }}" class="btn btn-primary">Bayar Sekarang</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div </div> -->
            </div>
    </section>
@endSection