// booking chart
$(document).ready(function() {
    if ($("#booking-chart").length) {
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
                            stepSize: 2,
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
                        barPercentage: .8,
                        categoryPercentage: .7,
                    }]
                },
                legend: {
                    display: false
                }
            }
        });
    }

    // riwayat
    if ($("#riwayat-chart").length) {
        $.ajax({
            url: '/chart/riwayat',
            method: 'GET',
            success: function(response) {
                var labels = response.map(item => item.date);
                var data = response.map(item => item.count);

                var areaData = {
                    labels: labels,
                    datasets: [
                        {
                            data: data,
                            borderColor: ['#1faf47'],
                            borderWidth: 3,
                            fill: false,
                            label: "services"
                        },
                    ]
                };

                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            ticks: {
                                display: false,
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false,
                                color: 'transparent',
                                zeroLineColor: '#eeeeee'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                autoSkip: false,
                                maxRotation: 0,
                                stepSize: 100,
                                fontColor: "#000",
                                fontSize: 14,
                                padding: 18,
                                stepSize: 1000,
                                max: 3000,
                                fontSize: 10,
                                fontColor: "#b1b0b0",
                                callback: function(value) {
                                    var ranges = [
                                        { divider: 1e6, suffix: 'M' },
                                        { divider: 1e3, suffix: 'k' }
                                    ];
                                    function formatNumber(n) {
                                        for (var i = 0; i < ranges.length; i++) {
                                            if (n >= ranges[i].divider) {
                                                return (n / ranges[i].divider).toString() + ranges[i].suffix;
                                            }
                                        }
                                        return n;
                                    }
                                    return formatNumber(value);
                                }
                            },
                            gridLines: {
                                drawBorder: false,
                                color: "#f8f8f8",
                                zeroLineColor: "#f8f8f8"
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    elements: {
                        line: {
                            tension: 0
                        },
                        point: {
                            radius: 0
                        }
                    }
                }

                var balanceChartCanvas = $("#riwayat-chart").get(0).getContext("2d");
                var balanceChart = new Chart(balanceChartCanvas, {
                    type: 'pie',
                    data: areaData,
                    options: areaOptions
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // user aktivitas
    if ($("#user-aktifitas").length) {
        $.ajax({
            url: '/chart/user',
            method: 'GET',
            success: function(response) {
                var labels = response.map(item => item.date);
                var data = response.map(item => item.count);

                var areaData = {
                    labels: labels,
                    datasets: [
                        {
                            data: data,
                            borderColor: ['#1faf47'],
                            borderWidth: 3,
                            fill: false,
                            label: "User Activity"
                        },
                    ]
                };

                var areaOptions = {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false,
                                color: 'transparent',
                                zeroLineColor: '#eeeeee'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            ticks: {
                                display: true,
                                autoSkip: false,
                                maxRotation: 0,
                                stepSize: 1,
                                fontColor: "#000",
                                fontSize: 14,
                                padding: 18,
                                callback: function(value) {
                                    var ranges = [
                                        { divider: 1e6, suffix: 'M' },
                                        { divider: 1e3, suffix: 'k' }
                                    ];
                                    function formatNumber(n) {
                                        for (var i = 0; i < ranges.length; i++) {
                                            if (n >= ranges[i].divider) {
                                                return (n / ranges[i].divider).toString() + ranges[i].suffix;
                                            }
                                        }
                                        return n;
                                    }
                                    return formatNumber(value);
                                }
                            },
                            gridLines: {
                                drawBorder: false,
                                color: "#f8f8f8",
                                zeroLineColor: "#f8f8f8"
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true
                    },
                    elements: {
                        line: {
                            tension: 0
                        },
                        point: {
                            radius: 0
                        }
                    }
                }

                var userActivityChartCanvas = $("#user-aktifitas").get(0).getContext("2d");
                var userActivityChart = new Chart(userActivityChartCanvas, {
                    type: 'line',
                    data: areaData,
                    options: areaOptions
                });
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
   
});


