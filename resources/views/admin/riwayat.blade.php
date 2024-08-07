@extends('layout.admins')

@section('konten')

<div class=" container my-5 p-3 bg-body rounded shadow-sm">


    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="riwayat-table" data-url="{{ route('admin.riwayat.data') }}">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">No</th>
                    <th class="col-md-1 text-center">Kode</th>
                    <th class="col-md-1 text-center">Kamar</th>
                    <th class="col-md-2 text-center">Nama</th>
                    <th class="col-md-1 text-center">Phone</th>
                    <th class="col-md-1 text-center">Tanggal Pemesanan</th>
                    <th class="col-md-1 text-center">Total</th>
                    <th class="col-md-1 text-center">Status</th>
                    <th class="col-md-2 text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    @foreach($riwayat as $item)
    <div class="modal fade" id="detail{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Riwayat Pesanan</h1>
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
                                        <p><strong>Kode Pemesanan:</strong> </p>
                                        <p><strong>Tanggal Pemesanan:</strong> {{ $item->tanggal_pemesanan }}</p>
                                        <p><strong>Status:</strong> {{ $item->status }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                        <h5>Detail Kamar</h5>
                                        <p><strong>Kategori Kamar:</strong> {{ $item->jenis_kamar }}</p>
                                        <p><strong>Nomor Kamar:</strong> {{ $item->nama_kamar }}</p>
                                        <p><strong>Jumlah Orang:</strong> {{ $item->jumlah_orang }}</p>
                                    </div>
                                    <div class="col">
                                        <h5>Durasi Menginap</h5>
                                        <p><strong>Check-in:</strong> {{ $item->tanggal_checkin }}</p>
                                        <p><strong>Check-out:</strong> {{ $item->tanggal_checkout }}</p>
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
                                    <button class="btn btn-primary" onclick="window.print()">Print Nota</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- <form role="form" method="POST" action="/update/kamar">
                                    @csrf
                                    <div class="form">
                                        <h1>{{$item->kode}}</h1>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form> -->

                </div>

            </div>
        </div>
    </div>
    @endforeach

    <!-- <a href="/cetak/admin" class="btn btn-primary" target="_blank"><i class="fa-solid fa-print"></i> Cetak PDF</a> -->



</div>

@endSection

@section('script')
<script src="{{asset('assets/js/datatables.js')}}"></script>


@endSection