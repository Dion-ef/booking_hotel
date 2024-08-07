@extends('layout.admins')


@section('konten')

<div class=" container p-3 bg-body rounded shadow-xl">

    <div class="search-container">
        <div class="row justify-content-between">
            <div class="col-md-9">
                <div class="pb-4">
                    <a class="btn btn-primary r-btn" data-bs-toggle="modal" data-bs-target="#tambahKamar" data-aos="fade">+Tambah Kamar</a>

                    <div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kamar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" method="POST" action="/tambah/kamar">
                                        @csrf
                                        <div class="form">
                                            <label for="name" class="form-label fw-bold">Nama</label>
                                            <input type="name" name="nama" class="form-control mb-3" required>
                                            <label class="fw-bold mb-1" for="kategori">Jenis Kamar</label>
                                            <select class="form-select mb-3" id="kategori_id" name="kategori_id" required>
                                                @foreach ($kategori as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                                @endforeach
                                            </select>
                                            <label class="fw-bold mb-1" for="kategori">Status</label>
                                            <select class="form-select mb-3" name="status" required>
                                                <option value="kosong">kosong</option>
                                                <option value="dipakai">dipakai</option>
                                            </select>
                                            <label for="status" class="form-label fw-bold">Kapasitas</label>
                                            <input type="status" name="kapasitas" class="form-control" required>
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



    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="kamar-table" data-url="{{ route('kamar.data') }}">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">No</th>
                    <th class="col-md-1 text-center">Nama Kamar</th>
                    <th class="col-md-1 text-center">Jenis Kamar</th>
                    <th class="col-md-1 text-center">Harga</th>
                    <th class="col-md-1 text-center">Kapasitas</th>
                    <th class="col-md-1 text-center">Status</th>
                    <th class="col-md-2 text-center">Aksi</th>

                </tr>
            </thead>
        </table>
    </div>


    <div class="modal fade" id="editKamarModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editKamarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editKamarModalLabel">Edit Kamar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <form role="form" method="POST" action="{{ route('kamar.update') }}">
                        @csrf
                        <div class="form">
                            <input type="hidden" name="id" id="edit-id">
                            <label for="nama" class="form-label text-start fw-bold">Nama</label>
                            <input type="text" name="nama" id="edit-nama" class="form-control">
                            <label class="fw-bold mb-1" for="kategori_id">Kategori</label>
                            <select class="form-select mb-3" id="edit-kategori_id" name="kategori_id">
                                @foreach ($kategori as $m)
                                <option value="{{ $m->id }}">{{ $m->nama }}</option>
                                @endforeach
                            </select>
                            <label class="fw-bold mb-1" for="status">Status</label>
                            <select class="form-select mb-3" name="status" id="edit-status">
                                <option value="kosong">Kosong</option>
                                <option value="dipakai">Dipakai</option>
                            </select>
                            <label for="kapasitas" class="form-label fw-bold">Kapasitas</label>
                            <input type="text" name="kapasitas" id="edit-kapasitas" class="form-control">
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
@endSection

@section('script')
<script src="{{asset('assets/js/datatables.js')}}"></script>

@endSection