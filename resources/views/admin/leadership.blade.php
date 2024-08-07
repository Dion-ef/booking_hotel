@extends('layout.admins')

@section('konten')

<div class=" container p-3 bg-body rounded shadow-xl">

    <div class="search-container">
        <div class="row justify-content-between">
            <div class="col-md-9">
                <div class="pb-4">
                    <a class="btn btn-primary r-btn" data-bs-toggle="modal" data-bs-target="#tambahLeadership" data-aos="fade">+Tambah Leadership</a>

                    <div class="modal fade" id="tambahLeadership" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Leadership</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" method="POST" action="/tambah/leadership" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form">
                                            <label for="name" class="form-label fw-bold">Nama</label>
                                            <input type="name" name="nama" class="form-control mb-3" required>
                                            <label for="name" class="form-label fw-bold">Jabatan</label>
                                            <input type="name" name="jabatan" class="form-control mb-3" required>
                                            <div class="mb-3">
                                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Motivasi</label>
                                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="motivasi"></textarea>
                                            </div>
                                            <label for="name" class="form-label fw-bold">Gambar</label>
                                            <div class="input-group mb-3 d-flex">
                                                <input type="file" class="form-control" id="inputGroupFile02" name="gambar">
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
    </div>



    <div class="">
        <p class="header-table">Leadership</p>
        <table class="table table-striped table-bordered text-center" id="leader-table" data-url="{{route('admin.leadership.data')}}">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">No</th>
                    <th class="col-md-1 text-center">Nama</th>
                    <th class="col-md-1 text-center">Jabatan</th>
                    <th class="col-md-1 text-center">Gambar</th>
                    <th class="col-md-2 text-center">Aksi</th>

                </tr>
            </thead>
        </table>
    </div>


    @foreach($leadership as $item)
    <div class="modal fade" id="editLeadership{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editLeadershipLabel{{$item->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel{{$item->id}}">Edit Leadership</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">

                    <form role="form" method="POST" action="/update/leadership" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
                            <label for="jabatan" class="form-label fw-bold">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control mb-3" value="{{ $item->jabatan }}" required>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Motivasi</label>
                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="motivasi">{{$item->motivasi}}</textarea>
                            </div>
                            <label for="name" class="form-label fw-bold">Gambar</label>
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar" class="img-thumbnail mb-2" style="max-width: 100%; width:150px;">
                                <input type="file" class="form-control" id="inputGroupFile02" name="gambar">
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

    @foreach($leadership as $item)
    <div class="modal fade" id="detailLeadership{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailLeadershipLabel{{$item->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailLeadershipLabel{{$item->id}}">Detail Leadership</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="form-group mb-3">
                        <label for="nama_hotel" class="form-label fw-bold">Nama</label>
                        <p>{{ $item->nama }}</p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label fw-bold">Jabatan</label>
                        <p>{{ $item->jabatan }}</p>
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label fw-bold">Motivasi</label>
                        <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="motivasi">{{$item->motivasi}}</textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="img" class="form-label fw-bold">Gambar</label>
                        <div>
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="Image" class="img-thumbnail" style="max-width: 100%;">
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