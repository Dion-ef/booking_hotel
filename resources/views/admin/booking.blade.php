@extends('layout.admins')

@section('konten')

<div class=" container my-5 p-3 bg-body rounded shadow-sm">


    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="booking-table" data-url="{{ route('admin.booking.data') }}">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">No</th>
                    <th class="col-md-1 text-center">Kode</th>
                    <th class="col-md-1 text-center">Kamar</th>
                    <th class="col-md-2 text-center">Nama</th>
                    <th class="col-md-1 text-center">Check In</th>
                    <th class="col-md-1 text-center">Check Out</th>
                    <th class="col-md-1 text-center">Jumlah Orang</th>
                    <th class="col-md-1 text-center">Total</th>
                    <th class="col-md-1 text-center">Status</th>
                    <th class="col-md-2 text-center">Aksi</th>

                </tr>
            </thead>
        </table>

    </div>

    @foreach($pemesanan as $item)
    <div class="modal fade" id="detail{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="container-booking">
                        <h1 class="text-center mb-4">Detail Pemesanan</h1>
                        <div class="card shadow-lg p-4">
                            <div class="card-body">
                                <div class="row mb-3 text-center">
                                    <div class="col">
                                        <h3 class="font-weight-bold">Pama Hotel</h3>
                                        <p class="text-muted">Jl. Panglima Sudirman Gg. 8 No.16, Kepatihan,<br>Kec.Tulungagung, Kabupaten Tulungagung<br><i class="fa fa-phone"></i> Telepon: 0123-456789</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold"><i class="fa fa-user"></i> Informasi Pemesan</h5>
                                        <p><strong>Nama:</strong> {{ $item->nama }}</p>
                                        <p><strong>Email:</strong> {{ $item->email }}</p>
                                        <p><strong>Telepon:</strong> {{ $item->phone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold"><i class="fa fa-info-circle"></i> Informasi Pesanan</h5>
                                        <p><strong>Kode Pemesanan:</strong> {{ $item->kode }}</p>
                                        <p><strong>Tanggal Pemesanan:</strong> {{ $item->tgl_pemesanan }}</p>
                                        <p><strong>Status:</strong>
                                            @if ($item->status == 'paid')
                                            <span class="badge badge-success text-capitalize"">{{ $item->status }}</span>
                                            @elseif ($item->status == 'unpaid')
                                            <span class="badge badge-danger text-capitalize"">{{ $item->status }}</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold"><i class="fa fa-bed"></i> Detail Kamar</h5>
                                        <p><strong>Kategori Kamar:</strong> {{ $item->kategori->nama }}</p>
                                        <p><strong>Nomor Kamar:</strong> {{ $item->kamar->nama }}</p>
                                        <p><strong>Jumlah Orang:</strong> {{ $item->jumlah_orang }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="font-weight-bold"><i class="fa fa-calendar"></i> Durasi Menginap</h5>
                                        <p><strong>Check-in:</strong> {{ $item->in }}</p>
                                        <p><strong>Check-out:</strong> {{ $item->out }}</p>
                                        <p><strong>Total Hari:</strong> {{ $item->duration }} malam</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col">
                                        <h5 class="font-weight-bold"><i class="fa fa-money-bill-wave"></i> Rincian Biaya</h5>
                                        <p><strong>Harga per Malam:</strong> Rp {{ number_format($item->harga, 0, ',', '.') }}</p>
                                        <p><strong>Total Biaya:</strong> Rp {{ number_format($item->total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row mt-4 text-center">
                                    <div class="col">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @endforeach

    @foreach($pemesanan as $item)
    <div class="modal fade" id="edit{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Pesanan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form role="form" method="POST" action="/update/booking">
                        @csrf
                        <div class="form">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="nama" class="form-label text-start fw-bold">Nama</label>
                            <input type="nama" name="nama" class="form-control mb-2" value="{{$item->nama}}">
                            <label for="nama" class="form-label text-start fw-bold">Email</label>
                            <input type="nama" name="email" class="form-control mb-2" value="{{$item->email}}">
                            <label for="nama" class="form-label text-start fw-bold">Phone</label>
                            <input type="nama" name="phone" class="form-control mb-2" value="{{$item->phone}}">
                            <label for="nama" class="form-label text-start fw-bold mb-2">Kamar</label>
                            <select class="form-select mb-3" id="kamar_id" name="kamar_id">
                                @foreach ($kamar as $m)
                                <option value="{{$m->id}}" {{ $m->id == $item->kamar_id ? 'selected' : '' }}>{{$m->nama}}</option>
                                @endforeach
                            </select>
                            <label for="nama" class="form-label text-start fw-bold">Jumlah Orang</label>
                            <input type="nama" name="jumlah_orang" class="form-control mb-2" value="{{$item->jumlah_orang}}">
                            <div>
                                <label class="text-black fw-bold" for="checkin_date">Date Check In</label>
                                <input type="date" id="checkin_date" name="Checkin" class="form-control mb-2" value="{{ $item->in ? \Carbon\Carbon::parse($item->in)->format('Y-m-d') : '' }}">
                            </div>

                            <div>
                                <label class="text-black fw-bold" for="checkin_date">Date Check Out</label>
                                <input type="date" id="checkin_date" name="Checkout" class="form-control mb-2" value="{{ $item->out ? \Carbon\Carbon::parse($item->out)->format('Y-m-d') : '' }}">
                            </div>
                            <label for="tgl_pemesanan" class="form-label fw-bold">Tanggal_pemesanan</label>
                            <input type="status" name="tgl_pemesanan" class="form-control mb-2" value="{{$item->tgl_pemesanan}}">
                            <label for="status" class="form-label fw-bold">Harga</label>
                            <input type="status" name="harga" class="form-control mb-2" value="{{$item->harga}}">
                            <label for="status" class="form-label fw-bold">Total</label>
                            <input type="status" name="total" class="form-control mb-2" value="{{$item->total}}">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-select mb-3" name="status">
                                <option value="unpaid" {{ $item->status == 'unpaid' ? 'selected' : '' }}>unpaid</option>
                                <option value="paid" {{ $item->status == 'paid' ? 'selected' : '' }}>paid</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    @endforeach




</div>

@endSection

@section('script')
<script src="{{asset('assets/js/datatables.js')}}"></script>


@endSection