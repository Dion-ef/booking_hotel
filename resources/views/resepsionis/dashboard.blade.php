@extends('layout.resepsionis')

@section('link')
<link href="{{asset('assets/admin/css/styleku.css')}}" rel="stylesheet">

@endSection
@section('konten')
<div class="row mb-5 mt-5">

<div class="col-md-3">
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
    <div class="col-md-3">
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

    <div class="col-md-3">
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

    <div class="col-md-3">
        <div class="d-container-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-col-container">
                        <h6>{{$checkInHariIni}}</h6>
                        <p>Tamu Check-In Hari Ini</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="child-4-container">
                        <i class="fa fa-user sidebar-icon" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>

<div class="chart">
    <div class="row">
        <div class="col-md-6 mb-4">

            <div class="chart-container">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <p class="card-titles fw-bold mb-5">Total Booking Dalam Satu Bulan</p>
                </div>

                <canvas id="booking-chart" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="chart-container">
                <div class="d-flex align-items-center justify-content-between flex-wrap">
                    <p class="card-titles fw-bold mb-5">Kamar Favorit</p>
                </div>
                <canvas id="kamarChart" height="200"></canvas>
            </div>
        </div>
    </div>

</div>

@endSection
@section('script')

<script src="{{asset('assets/js/chartku.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endSection