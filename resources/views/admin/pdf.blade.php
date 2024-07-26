<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    

<div class=" container my-5 p-3 bg-body rounded shadow-sm">

<div class="table">
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th class="col-md-1">No</th>
                <th class="col-md-1">Kamar</th>
                <th class="col-md-1">Nama</th>
                <th class="col-md-1">Tanggal Pemesanan</th>
                <th class="col-md-1">Check In</th>
                <th class="col-md-1">Check Out</th>
                <th class="col-md-1">Total</th>

            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $item->nama_kamar}}</td>
                <td>{{ $item->nama}}</td>
                <td>{{ $item->tanggal_pemesanan}}</td>
                <td>{{ $item->tanggal_checkin}}</td>
                <td>{{ $item->tanggal_checkout}}</td>
                <td>Rp.{{ number_format($item->total)}}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>



</div>
</body>
</html>