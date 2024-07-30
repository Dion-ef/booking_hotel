$(document).ready(function() {
    if ($("#booking-chart").length) {
        // Ambil data dari elemen #chartData
        var chartDataElem = $('#chartData');
        var months = JSON.parse(chartDataElem.attr('data-months'));
        var bookingsData = JSON.parse(chartDataElem.attr('data-bookings'));

        var BookingChartCanvas = $("#booking-chart").get(0).getContext("2d");
        var BookingChart = new Chart(BookingChartCanvas, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Jumlah Pemesanan',
                    data: bookingsData,
                    backgroundColor: '#1cbccd'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                layout: {
                    padding: {
                        left: 0,
                        right: 0,
                        top: 20,
                        bottom: 0
                    }
                },
                scales: {
                    yAxes: [{
                        display: true,
                        gridLines: {
                            display: true,
                            drawBorder: false,
                            color: "#f8f8f8",
                            zeroLineColor: "#f8f8f8"
                        },
                        ticks: {
                            display: true,
                            min: 0,
                            stepSize: 5,
                            fontColor: "#b1b0b0",
                            fontSize: 10,
                            padding: 10
                        }
                    }],
                    xAxes: [{
                        stacked: false,
                        ticks: {
                            beginAtZero: true,
                            fontColor: "#b1b0b0",
                            fontSize: 10
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, 0)",
                            display: false
                        },
                        barPercentage: .9,
                        categoryPercentage: .7,
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    }
});

$(document).ready(function() {
    if ($("#audien-chart").length) {
        $.ajax({
            url: '/dashboard/admin', // Ubah URL sesuai dengan rute endpoint Anda
            method: 'GET',
            success: function(response) {
                var AudienceChartCanvas = $("#audien-chart").get(0).getContext("2d");
                var AudienceChart = new Chart(AudienceChartCanvas, {
                    type: 'bar',
                    data: {
                        labels: response.months,
                        datasets: [
                            {
                                type: 'line',
                                fill: false,
                                data: response.lineData,
                                borderColor: '#ff4c5b'
                            },
                            {
                                label: 'Offline Sales',
                                data: response.offlineSales,
                                backgroundColor: '#6640b2'
                            },
                            {
                                label: 'Online Sales',
                                data: response.onlineSales,
                                backgroundColor: '#1cbccd'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 20,
                                bottom: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#f8f8f8",
                                    zeroLineColor: "#f8f8f8"
                                },
                                ticks: {
                                    display: true,
                                    min: 0,
                                    max: 400,
                                    stepSize: 100,
                                    fontColor: "#b1b0b0",
                                    fontSize: 10,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#b1b0b0",
                                    fontSize: 10
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                    display: false
                                },
                                barPercentage: .9,
                                categoryPercentage: .7,
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 3,
                                backgroundColor: '#ff4c5b'
                            }
                        }
                    },
                });
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }
});