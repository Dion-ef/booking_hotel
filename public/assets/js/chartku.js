// booking chart
$(document).ready(function() {
    if ($("#booking-chart").length) {
        $.ajax({
            url: '/chart/booking', // Ganti dengan URL endpoint Anda
            method: 'GET',
            success: function(response) {
                var months = response.months;
                var bookingsData = response.bookingsData;
    
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
                                barPercentage: .8,
                                categoryPercentage: .7,
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            },
            error: function(error) {
                console.log('Error:', error);
            }
        });
    }


    if ($("#kamarChart").length) {
        fetch('/chart/kamar')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(item => item.kamar.nama); 
                const values = data.map(item => item.total_bookings);
                const total = values.reduce((acc, val) => acc + val, 0);
    
                console.log('Labels:', labels);
                console.log('Values:', values);
                console.log('Total:', total);
    
                const ctx = document.getElementById('kamarChart').getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#33FF57','#000','#DDD','#ff0000','#02a526','#510097'], // Customize colors as needed
                        }]
                    },
                    options: {
                        responsive: true,

                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        console.log('Context:', context);
                                        const value = context.raw;
                                        const total = context.chart.data.datasets[0].data.reduce((acc, val) => acc + val, 0);
                                        console.log('Total:', total);
    
                                        const percentage = ((value / total) * 100).toFixed(2);
                                        console.log(`Label: ${context.label}, Value: ${value}, Percentage: ${percentage}`);
    
                                        return `Kamar ${context.label}: dibooking ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    }

});





