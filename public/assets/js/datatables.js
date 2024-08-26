// Kamar
$(document).ready(function() {
    var ajaxUrl = $('#kamar-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);

    var table = $('#kamar-table').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
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

    $('#kamar-table').on('click', '.delete-button', function (event) {
        event.preventDefault();
        const kamarId = $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan bisa mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ambil token CSRF dari meta tag
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Jika dikonfirmasi, submit form untuk menghapus kamar
                const form = document.createElement('form');
                form.action = `/hapus/kamar/`+ kamarId;
                form.method = 'POST';

                // Tambahkan token CSRF ke dalam form
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = token;
                form.appendChild(csrfInput);

                // Tambahkan metode delete ke dalam form
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'GET';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});


// Kategori
$(document).ready(function() {
    var ajaxUrl = $('#kategori-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);

     var table = $('#kategori-table').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
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

    $('#kategori-table').on('click', '.delete-button-kategori', function (event) {
        event.preventDefault();
        const kategoriId = $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan bisa mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ambil token CSRF dari meta tag
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Jika dikonfirmasi, submit form untuk menghapus kamar
                const form = document.createElement('form');
                form.action = `/hapus/kategori/`+ kategoriId;
                form.method = 'POST';

                // Tambahkan token CSRF ke dalam form
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = token;
                form.appendChild(csrfInput);

                // Tambahkan metode delete ke dalam form
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'GET';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });

    
});


// booking
$(document).ready(function() {
    var ajaxUrl = $('#booking-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);

    var table = $('#booking-table').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
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

    $('#booking-table').on('click', '.delete-button', function (event) {
        event.preventDefault();
        const id= $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Checkout ?',
            text: "Anda tidak akan bisa mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Checkout!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ambil token CSRF dari meta tag
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Jika dikonfirmasi, submit form untuk menghapus kamar
                const form = document.createElement('form');
                form.action = `/hapus/booking/`+ id;
                form.method = 'POST';

                // Tambahkan token CSRF ke dalam form
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = token;
                form.appendChild(csrfInput);

                // Tambahkan metode delete ke dalam form
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'GET';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});


// riwayat
$(document).ready(function() {
    var ajaxUrl = $('#riwayat-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#riwayat-table').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
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


// fasilitas
$(document).ready(function() {
    var ajaxUrl = $('#fasilitas-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#fasilitas-table').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data: 'nama', name: 'nama'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

      $('#fasilitas-table').on('click', '.delete-button', function (event) {
        event.preventDefault();
        const id= $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda tidak akan bisa mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ambil token CSRF dari meta tag
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Jika dikonfirmasi, submit form untuk menghapus kamar
                const form = document.createElement('form');
                form.action = `/hapus/fasilitas/`+ id;
                form.method = 'POST';

                // Tambahkan token CSRF ke dalam form
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = token;
                form.appendChild(csrfInput);

                // Tambahkan metode delete ke dalam form
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'GET';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });

});
// asset
$(document).ready(function() {
    var ajaxUrl = $('#asset-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#asset-table').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama_hotel', name: 'nama_hotel' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'alamat', name: 'alamat' },
            { data: 'background_img', name: 'background_img', orderable: false, searchable: false },
            { data: 'logo', name: 'logo', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },

        ]
    });
});
// leadership
$(document).ready(function() {
    var ajaxUrl = $('#leader-table').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#leader-table').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'nama', name: 'nama' },
            { data: 'jabatan', name: 'jabatan' },
            { data: 'gambar', name: 'gambar', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false },

        ]
    });
});










//resepsionis

// Kamar
$(document).ready(function() {
    var ajaxUrl = $('#resepsionis-kamar').data('url');
    console.log('AJAX URL: ', ajaxUrl);

    var table = $('#resepsionis-kamar').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
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
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
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

    $('#resepsionis-booking').on('click', '.delete-button', function (event) {
        event.preventDefault();
        const id= $(this).data('id');

        Swal.fire({
            title: 'Apakah Anda Yakin Ingin Checkout ?',
            text: "Anda tidak akan bisa mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Checkout!',
            cancelButtonText: 'Tidak, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Ambil token CSRF dari meta tag
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // Jika dikonfirmasi, submit form untuk menghapus kamar
                const form = document.createElement('form');
                form.action = `/hapus/booking/resepsionis/`+ id;
                form.method = 'POST';

                // Tambahkan token CSRF ke dalam form
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = token;
                form.appendChild(csrfInput);

                // Tambahkan metode delete ke dalam form
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'GET';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });

});

// riwayat
$(document).ready(function() {
    var ajaxUrl = $('#resepsionis-riwayat').data('url');
    console.log('AJAX URL: ', ajaxUrl);
    var table = $('#resepsionis-riwayat').DataTable({
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia di tabel",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sInfoThousands": ".",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sLoadingRecords": "Sedang memuat...",
            "sProcessing": "Sedang memproses...",
            "sSearch": "Cari:",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "oPaginate": {
                "sFirst": "Pertama",
                "sLast": "Terakhir",
                "sNext": "Berikutnya",
                "sPrevious": "Sebelumnya"
            },
            "oAria": {
                "sSortAscending": ": aktifkan untuk menyortir kolom secara ascending",
                "sSortDescending": ": aktifkan untuk menyortir kolom secara descending"
            }
        },
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

