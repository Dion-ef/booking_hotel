document.addEventListener("DOMContentLoaded", function() {
    var bookingChartElement = document.getElementById('bookingChart');
    var bookings = JSON.parse(bookingChartElement.getAttribute('data-bookings'));

    var ctx = bookingChartElement.getContext('2d');
    var bookingChart = new Chart(ctx, {
        type: 'pie', // tipe chart bisa disesuaikan
        data: {
            labels: bookings.map(booking => booking.date),
            datasets: [{
                label: 'Jumlah Pemesanan',
                data: bookings.map(booking => booking.count),
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});