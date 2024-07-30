@extends('layout.resepsionis')

@section('konten')

<div class=" container p-3 bg-body rounded shadow-xl">



    <div class="table-responsive">
        <table class="table table-striped table-bordered text-center" id="resepsionis-kamar" data-url="{{ route('resepsionis.kamar') }}">
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


    @foreach($kamar as $item)
    <div class="modal fade" id="detailKamar{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editKamarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailKamar{{ $item->id }}">Detail Kamar: {{ $item->nama }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <p><strong>Nama:</strong> {{ $item->nama }}</p>
                    <p><strong>Harga:</strong> Rp. {{ number_format($item->kategori->harga) }} / per malam</p>
                    <p><strong>Status:</strong> {{$item->status}}</p>
                    <!-- <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p> -->
                    <p><strong>Fasilitas:</strong></p>
                    <ul>
                        @foreach($item->kategori->fasilitas as $fasilitas)
                        <li>{{ $fasilitas->nama }}</li>
                        @endforeach
                    </ul>
                    <!-- <figure class="img-wrap">
                        <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
                            @if (isset($gambar[$item->kategori->id]))
                            @foreach($gambar[$item->kategori->id] as $img)
                            <div class="slider-item">
                                <img src="{{ asset('storage/' . $img->gambar) }}" alt="Gambar Kategori" class="fixed-height-img">
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </figure> -->
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endSection

@section('script')
<script src="{{asset('assets/js/datatables.js')}}"></script>
<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $('.home-slider').owlCarousel({
            loop: true, // Loop kembali ke gambar pertama setelah gambar terakhir
            margin: 10,
            nav: true,
            items: 1,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
    });
</script>
@endSection