@extends('layout.admins')

@section('link')
<link href="{{asset('assets/admin/css/styleku.css')}}" rel="stylesheet">

@endSection
@section('konten')
<!-- bisa pakai class data dan hapus col -->
<div class="row mb-5 mt-5"> 

    <div class="col-md-4">
        <div class="d-container-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-col-container">
                        <h6>{{$totalKamarKosong}}</h6>
                        <p>Kamar Tersedia</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="child-1-container">
                        <i class="fa fa-store sidebar-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="d-container-1">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-col-container">
                        <h6>{{$totalKamarTerpakai}}</h6>
                        <p>Kamar Terpakai</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="child-2-container">
                        <i class="fa fa-folder-open sidebar-icon" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="d-container-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-col-container">
                        <h6>{{$totalBooking}}</h6>
                        <p>Total Booking</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="child-3-container">
                        <i class="fa fa-cart-shopping sidebar-icon" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>


<div class="chart">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div id="chartData" data-months="{{ json_encode($months) }}" data-bookings="{{ $bookingsJson }}">
            </div>

            <div class="chart-container">
                <h6>total booking perbulan</h6>
                <canvas id="booking-chart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="chart-container">
                <canvas id="riwayat-chart"></canvas>
            </div>
        </div>
        <!-- <div class="col-md-6 mb-4">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="chart-container">
                        <h6>jumlah user yang login</h6>
                        <canvas id="user-aktifitas"></canvas>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="chart-container">
                        <h6></h6>
                        <canvas id="user-aktifitas"></canvas>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

</div>
@endSection
@section('script')

<script src="{{asset('assets/js/chartku.js')}}"></script>
@endSection