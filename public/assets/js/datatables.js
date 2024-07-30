// Kamar
$(document).ready(function() {
    var ajaxUrl = $('#kamar-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);

    var table = $('#kamar-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        pageLength: 10, // Atur jumlah data per halaman
        lengthMenu: [5, 10, 25, 50, 100],
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'kategori.nama',
                name: 'kategori.nama'
            },
            {
                data: 'kategori.harga',
                name: 'kategori.harga',
                render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.')
            },
            {
                data: 'kapasitas',
                name: 'kapasitas'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ]
    });

    // edit
    $('#kamar-table').on('click', '.btn-action', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '/kamar/' + id,
            method: 'GET',
            success: function(data) {
                $('#edit-id').val(data.id);
                $('#edit-nama').val(data.nama);
                $('#edit-kategori_id').val(data.kategori_id);
                $('#edit-status').val(data.status);
                $('#edit-kapasitas').val(data.kapasitas);
                $('#editKamarModal').modal('show');
            }
        });
    });
});


// Kategori
$(document).ready(function() {
    var ajaxUrl = $('#kategori-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);

     var table = $('#kategori-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        pageLength: 5, // Atur jumlah data per halaman
        lengthMenu: [5, 10, 25, 50, 100],
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'harga', name: 'harga', render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.') },
            { data: 'fasilitas', name: 'fasilitas' },
            { data: 'gambar', name: 'gambar', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    // edit
    $(document).on('click', '.edit-button', function () {
        var id = $(this).data('id');
        
        // Ambil data untuk ID yang dipilih
        $.ajax({
            url: '/kategori/' + id, // Route untuk mendapatkan detail kategori
            method: 'GET',
            success: function (data) {
                // Isi form modal dengan data
                $('#edit-id').val(data.id);
                $('#edit-nama').val(data.nama);
                $('#edit-harga').val(data.harga);
                
                // Handle fasilitas
                $('#edit-fasilitas').val(data.fasilitas_id); // Anda perlu memastikan data.fasilitas_ids berisi array ID fasilitas yang dipilih
    
                // Show the modal
                $('#editKategori').modal('show');
            }
        });
    });
    
});


// booking
$(document).ready(function() {
    var ajaxUrl = $('#booking-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);

    var table = $('#booking-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        pageLength: 5, // Atur jumlah data per halaman
        lengthMenu: [5, 10, 25, 50, 100],
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode', name: 'kode' },
            { data: 'kamar.nama', name: 'kamar.nama' },
            { data: 'nama', name: 'nama' },
            { data: 'in', name: 'in' },
            { data: 'out', name: 'out' },
            { data: 'jumlah_orang', name: 'jumlah_orang' },
            { data: 'total', name: 'total', render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.') },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

    // Handle edit button click
    $('#booking-table').on('click', '.btn-action', function() {
        var id = $(this).data('id');

        $.ajax({
            url: '/booking/' + id,
            method: 'GET',
            success: function(data) {
                // Handle the response data to show in the modal
                $('#edit-id').val(data.id);
                $('#edit-nama').val(data.nama);
                // Populate other fields as needed
                $('#editBookingModal').modal('show');
            }
        });
    });
});


// riwayat
$(document).ready(function() {
    var ajaxUrl = $('#riwayat-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#riwayat-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode', name: 'kode' },
            { data: 'nama_kamar', name: 'nama_kamar' },
            { data: 'nama', name: 'nama' },
            { data: 'phone', name: 'phone' },
            { data: 'tanggal_pemesanan', name: 'tanggal_pemesanan' },
            { data: 'total', name: 'total', render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.') },
            { data: 'status', name: 'status', render: function(data, type, row) {
                return '<span class="text-danger">' + data + '</span>';
            }},
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});


// fasilitas
$(document).ready(function() {
    var ajaxUrl = $('#fasilitas-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#fasilitas-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'nama', name: 'nama'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

});


//resepsionis

// Kamar
$(document).ready(function() {
    var ajaxUrl = $('#resepsionis-kamar').data('url');
    console.log('AJAX URL: ', ajaxUrl);

    var table = $('#resepsionis-kamar').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        pageLength: 10, // Atur jumlah data per halaman
        lengthMenu: [5, 10, 25, 50, 100],
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'nama',
                name: 'nama'
            },
            {
                data: 'kategori.nama',
                name: 'kategori.nama'
            },
            {
                data: 'kategori.harga',
                name: 'kategori.harga',
                render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.')
            },
            {
                data: 'kapasitas',
                name: 'kapasitas'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'actions',
                name: 'actions',
                orderable: false,
                searchable: false
            },
        ]
    });


});

// booking
$(document).ready(function() {
    var ajaxUrl = $('#resepsionis-booking').data('url');
    console.log('AJAX URL: ', ajaxUrl);

    var table = $('#resepsionis-booking').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        pageLength: 5, // Atur jumlah data per halaman
        lengthMenu: [5, 10, 25, 50, 100],
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode', name: 'kode' },
            { data: 'kamar.nama', name: 'kamar.nama' },
            { data: 'nama', name: 'nama' },
            { data: 'in', name: 'in' },
            { data: 'out', name: 'out' },
            { data: 'jumlah_orang', name: 'jumlah_orang' },
            { data: 'total', name: 'total', render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.') },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });

});

// riwayat
$(document).ready(function() {
    var ajaxUrl = $('#resepsionis-riwayat').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#resepsionis-riwayat').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'kode', name: 'kode' },
            { data: 'nama_kamar', name: 'nama_kamar' },
            { data: 'nama', name: 'nama' },
            { data: 'phone', name: 'phone' },
            { data: 'tanggal_pemesanan', name: 'tanggal_pemesanan' },
            { data: 'total', name: 'total', render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.') },
            { data: 'status', name: 'status', render: function(data, type, row) {
                return '<span class="text-danger">' + data + '</span>';
            }},
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
