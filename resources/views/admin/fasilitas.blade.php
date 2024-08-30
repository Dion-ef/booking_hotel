@extends('layout.admins')

@section('konten')

<div class=" container my-5 p-3 bg-body rounded shadow-sm">

    <div class="search-container">
        <div class="row justify-content-between">
            <div class="col-md-9">
                <div class="pb-4">
                    <a class="btn btn-primary r-btn" data-bs-toggle="modal" data-bs-target="#tambahKamar" data-aos="fade">+Tambah Fasilitas</a>

                    <div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Fasilitas</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form role="form" method="POST" action="/tambah/fasilitas">
                                        @csrf
                                        <div class="form">
                                            <label for="name" class="form-label fw-bold">Nama</label>
                                            <input type="name" name="nama" class="form-control" placeholder="Nama" required>
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
        <table class="table table-striped table-bordered text-center" id="fasilitas-table" data-url="{{ route('admin.fasilitas.data') }}">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">No</th>
                    <th class="col-md-1 text-center">Nama Fasilitas</th>
                    <th class="col-md-1 text-center">Aksi</th>

                </tr>
            </thead>
        </table>
    </div>


    @foreach($fasilitas as $item)
    <div class="modal fade" id="editFasilitas{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editFasilitasLabel{{$item->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel{{$item->id}}">Edit Fasilitas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">

                    <form role="form" method="POST" action="/update/fasilitas">
                        @csrf

                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="form-group mb-3">
                            <label for="nama" class="form-label fw-bold">Nama</label>
                            <input type="text" name="nama" class="form-control" value="{{ $item->nama }}" required>
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