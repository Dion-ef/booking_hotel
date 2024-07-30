@extends('layout.admins')

@section('link')
<link href="{{asset('assets/admin/css/styleku.css')}}" rel="stylesheet">
@endSection
@section('konten')
<!-- <div class="data">

    <div class="d-container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-col-container">
                    <h6>Jumlah Kamar :</h6>
                    <p>{{$totalKamar}} Kamar</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="child-1-container">
                    <i class="fa fa-store sidebar-icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="d-container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-col-container">
                    <p>xxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="child-2-container">
                    <i class="fa fa-folder-open sidebar-icon" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="d-container">
        <div class="row">
            <div class="col-md-6">
                <div class="d-col-container">
                    <p>{xxxxxxxxxxxxxxxxxxxxxxxxxxx}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="child-3-container">
                    <i class="fa fa-cart-shopping sidebar-icon" aria-hidden="true"></i>
                </div>
            </div>
        </div>
    </div>



</div> -->


<div class="chart">
    <div class="row">
        <div class="col-md-6">
            <div id="chartData" data-months="{{ json_encode($months) }}" data-bookings="{{ $bookingsJson }}">
            </div>

            <div class="chart-container">
                <canvas id="booking-chart" width="400" height="200"></canvas>
            </div>
        </div>
        <div class="col-md-6">
            <div class="chart-container">
                <canvas id="balance-chart" data-bookings="{{ $bookingsJson }}"></canvas>
            </div>
        </div>
    </div>

</div>
@endSection
@section('script')
<script src="{{asset('assets/js/chartku.js')}}"></script>
@endSection