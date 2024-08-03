@extends('layout.admins')

@section('konten')

<div class=" container my-5 p-3 bg-body rounded shadow-sm">
    <div class="pb-4">
        <a href="/barang/tambah" class="btn btn-primary r-btn" data-bs-toggle="modal" data-bs-target="#tambahKamar">+Tambah Kategori Kamar</a>

        <div class="modal fade" id="tambahKamar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kategori Kamar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="POST" action="/tambah/kategori">
                            @csrf
                            <div class="form">
                                <label for="name" class="form-label fw-bold">Nama</label>
                                <input type="name" name="nama" class="form-control mb-3" required>
                                <label for="status" class="form-label fw-bold">Harga</label>
                                <input type="status" name="harga" class="form-control mb-3" required>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="deskripsi"></textarea>
                                </div>
                                <label for="fasilitas" class="form-label fw-bold">Fasilitas</label>
                                <select name="fasilitas[]" class="selectpicker form-control" multiple data-live-search="true">
                                    @foreach ($fasilitas as $f)
                                    <option value="{{ $f->id }}">{{ $f->nama }}</option>
                                    @endforeach
                                </select>
                                <!-- <div>
                                    <label>Gambar:</label>
                                    <div class="dropzone" id="my-dropzone"></div>
                                    <input type="hidden" name="gambar" id="gambar-path">
                                </div> -->
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

    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="kategori-table" data-url="{{ route('admin.kategori.data') }}">
            <thead>
                <tr>
                    <th class="col-md-1 text-center">No</th>
                    <th class="col-md-1 text-center">Kategori Kamar</th>
                    <th class="col-md-1 text-center">Harga</th>
                    <th class="col-md-2 text-center">Fasilitas</th>
                    <th class="col-md-2 text-center">Gambar</th>
                    <th class="col-md-2 text-center">Aksi</th>

                </tr>
            </thead>
        </table>
    </div>
    @foreach($getgambar as $img)
    <div class="modal fade" id="gambar{{$img->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Gambar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">

                    <form role="form" method="GET" action="/hapus/gambar/{{$img->id}}">
                        @csrf
                        <div class="form">
                            <img src="{{ asset('storage/' . $img->gambar) }}" class="custom-img" alt="Gambar Kategori"></a>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" name="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
    @endforeach
    @foreach($kategori as $item)
    <div class="modal fade" id="editKategori{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Kategori Kamar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">

                    <form role="form" method="POST" action="/update/kategori">
                        @csrf
                        <div class="form">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <label for="nama" class="form-label text-start fw-bold">Nama</label>
                            <input type="nama" name="nama" class="form-control" value="{{$item->nama}}">
                            <label for="status" class="form-label fw-bold">Harga</label>
                            <input type="status" name="harga" class="form-control" value="{{$item->harga}}">
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control " id="exampleFormControlTextarea1" rows="3" name="deskripsi">{{ $item->deskripsi }}</textarea>
                            </div>
                            <label for="edit-fasilitas" class="form-label fw-bold">Fasilitas</label>
                            <select name="fasilitas[]" class="selectpicker form-control" multiple data-live-search="true">
                                <!-- Options will be dynamically loaded here -->
                                @foreach ($fasilitas as $f)
                                <option value="{{ $f->id }}" {{ in_array($f->id, $item->fasilitas->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $f->nama }}</option>
                                @endforeach
                            </select>
                            <!-- <div class="image-container">
                                            <label for="status" class="form-label">Gambar</label>
                                            @if (isset($gambar[$item->id]))
                                            @foreach($gambar[$item->id] as $img)
                                            <img src="{{ asset('storage/' . $img->gambar) }}" class="custom-img" alt="Gambar Kategori">
                                            @endforeach
                                            @endif

                                        </div> -->
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
    @foreach($kategori as $item)
    <div class="modal fade" id="gambarKategori{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gambar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">

                    <form role="form" method="POST" action="{{ route('kategori.tambah.gambar', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="input-group mb-3 d-flex">
                                <input type="file" class="form-control" id="inputGroupFile02" name="gambar[]" multiple>
                            </div>
                        </div>

                        <!-- <div class="image-container">
                                        @if (isset($gambar[$item->id]))
                                        @foreach($gambar[$item->id] as $img)
                                        <a data-bs-toggle="modal" data-bs-target="#gambar{{$img->id}}"><img src="{{ asset('storage/' . $img->gambar) }}" class="custom-img" alt="Gambar Kategori"></a>
                                        @endforeach
                                        @endif

                                    </div> -->
                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button> -->


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
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Select JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
    });
</script>

@endSection