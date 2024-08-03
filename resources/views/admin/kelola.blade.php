@extends('layout.admins')

@section('konten')

<div class=" container p-3 bg-body rounded shadow-xl">

    <!-- <div class="search-container">
        <div class="row justify-content-between">
            <div class="col-md-9">
                <div class="pb-4">
                    <a class="btn btn-primary r-btn" data-bs-toggle="modal" data-bs-target="#tambahKamar" data-aos="fade">+Tambah Kamar</a>

                    <div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Asset</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" method="POST" action="/tambah/asset" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form">
                                            <label for="name" class="form-label fw-bold">Nama Hotel</label>
                                            <input type="name" name="nama_hotel" class="form-control mb-3" required>
                                            <label for="name" class="form-label fw-bold">Email</label>
                                            <input type="name" name="email" class="form-control mb-3" required>
                                            <label for="name" class="form-label fw-bold">Phone</label>
                                            <input type="name" name="phone" class="form-control mb-3" required>
                                            <label for="name" class="form-label fw-bold">Alamat</label>
                                            <input type="name" name="alamat" class="form-control mb-3" required>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Headline</label>
                                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="headline"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="deskripsi"></textarea>
                                            </div>

                                            <label for="name" class="form-label fw-bold">Gambar Bakcground</label>
                                            <div class="input-group mb-3 d-flex">
                                                <input type="file" class="form-control" id="inputGroupFile02" name="background_img">
                                            </div>

                                            <label for="name" class="form-label fw-bold">Gambar Welcome</label>
                                            <div class="input-group mb-3 d-flex">
                                                <input type="file" class="form-control" id="inputGroupFile02" name="welcome_img">
                                            </div>
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
                </div>
            </div>
        </div>
    </div> -->



    <div class="">
        <p class="header-table">Asset</p>
        <table class="table table-striped table-bordered text-center" id="asset-table" data-url="{{route('admin.asset.data')}}">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">No</th>
                    <th class="col-md-1 text-center">Nama Hotel</th>
                    <th class="col-md-1 text-center">Email</th>
                    <th class="col-md-1 text-center">Phone</th>
                    <th class="col-md-1 text-center">Alamat</th>
                    <th class="col-md-1 text-center">Background Imgae</th>
                    <th class="col-md-2 text-center">Welcome Image</th>
                    <th class="col-md-2 text-center">Aksi</th>

                </tr>
            </thead>
        </table>
    </div>


    @foreach($asset as $item)
    <div class="modal fade" id="editAsset{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editFasilitasLabel{{$item->id}}" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel{{$item->id}}">Edit Asset</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">

                    <form role="form" method="POST" action="/update/asset" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label fw-bold">Nama Hotel</label>
                            <input type="nama_hotel" name="nama_hotel" class="form-control" value="{{ $item->nama_hotel }}" required>
                            <label for="name" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control mb-3" value="{{ $item->email }}" required>
                            <label for="name" class="form-label fw-bold">Phone</label>
                            <input type="phone" name="phone" class="form-control mb-3" value="{{ $item->phone }}" required>
                            <label for="name" class="form-label fw-bold">Alamat</label>
                            <input type="alamat" name="alamat" class="form-control mb-3" value="{{ $item->alamat }}" required>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Headline</label>
                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="headline">{{$item->headline}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="deskripsi">{{$item->deskripsi}}</textarea>
                            </div>
                            <label for="name" class="form-label fw-bold">Background Image</label>
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $item->background_img) }}" alt="Background Image" class="img-thumbnail mb-2" style="max-width: 100%; width:150px;">
                                <input type="file" class="form-control" id="inputGroupFile02" name="background_img">
                            </div>
                            <label for="name" class="form-label fw-bold">Welcome Image</label>
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $item->welcome_img) }}" alt="Background Image" class="img-thumbnail mb-2" style="max-width: 100%; width:150px;">
                                <input type="file" class="form-control" id="inputGroupFile02" name="welcome_img">
                            </div>
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

    @foreach($asset as $item)
    <div class="modal fade" id="detailAsset{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailAssetLabel{{$item->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailAssetLabel{{$item->id}}">Detail Asset</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="form-group mb-3">
                        <label for="nama_hotel" class="form-label fw-bold">Nama Hotel</label>
                        <p>{{ $item->nama_hotel }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <p>{{ $item->email }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone" class="form-label fw-bold">Phone</label>
                        <p>{{ $item->phone }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label fw-bold">Alamat</label>
                        <p>{{ $item->alamat }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="alamat" class="form-label fw-bold">Headline</label>
                        <p>{{ $item->headline }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi</label>
                        <p class="deskripsi-text">{{ $item->deskripsi }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="background_img" class="form-label fw-bold">Background Image</label>
                        <div>
                            <img src="{{ asset('storage/' . $item->background_img) }}" alt="Background Image" class="img-thumbnail" style="max-width: 100%;">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="welcome_img" class="form-label fw-bold">Welcome Image</label>
                        <div>
                            <img src="{{ asset('storage/' . $item->welcome_img) }}" alt="Welcome Image" class="img-thumbnail" style="max-width: 100%;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
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