<!-- Core JS Files -->
<script src="{{ asset('assets-admin/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/core/bootstrap.min.js') }}"></script>

<!-- jQuery (wajib pertama untuk plugin lain) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Moment.js & Daterangepicker -->
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Chart.js (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Plugin JS -->
<script src="{{ asset('assets-admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets-admin/js/plugins/chartjs.min.js') }}"></script>

<!-- Scrollbar Init -->
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), {
            damping: '0.5'
        });
    }
</script>

<!-- Material Dashboard -->
<script src="{{ asset('assets/js/material-dashboard.min.js?v=3.2.0') }}"></script>

<!-- Github Buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Custom JS -->
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- ChartJS Example (Bar, Line, Tasks) -->
<script>
    const chartConfig = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                grid: {
                    color: '#e5e5e5',
                    borderDash: [4, 4],
                    drawTicks: false
                },
                ticks: {
                    color: "#737373",
                    padding: 10,
                    font: {
                        size: 14,
                        lineHeight: 2
                    }
                }
            },
            x: {
                grid: {
                    display: false
                },
                ticks: {
                    color: '#737373',
                    padding: 10,
                    font: {
                        size: 14,
                        lineHeight: 2
                    }
                }
            }
        }
    };

    const barCtx = document.getElementById("chart-bars")?.getContext("2d");
    if (barCtx) {
        new Chart(barCtx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Views",
                    backgroundColor: "#43A047",
                    data: [50, 45, 22, 28, 50, 60, 76],
                    borderRadius: 4,
                    borderSkipped: false,
                    barThickness: 'flex'
                }]
            },
            options: chartConfig
        });
    }

    const lineCtx = document.getElementById("chart-line")?.getContext("2d");
    if (lineCtx) {
        new Chart(lineCtx, {
            type: "line",
            data: {
                labels: ["J", "F", "M", "A", "M", "J", "J", "A", "S", "O", "N", "D"],
                datasets: [{
                    label: "Sales",
                    data: [120, 230, 130, 440, 250, 360, 270, 180, 90, 300, 310, 220],
                    borderColor: "#43A047",
                    pointBackgroundColor: "#43A047",
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: "transparent"
                }]
            },
            options: {
                ...chartConfig,
                plugins: {
                    ...chartConfig.plugins,
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const months = ["January", "February", "March", "April", "May", "June",
                                    "July", "August", "September", "October", "November", "December"
                                ];
                                return months[context[0].dataIndex];
                            }
                        }
                    }
                }
            }
        });
    }

    const taskCtx = document.getElementById("chart-line-tasks")?.getContext("2d");
    if (taskCtx) {
        new Chart(taskCtx, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Tasks",
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    borderColor: "#43A047",
                    pointBackgroundColor: "#43A047",
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: "transparent"
                }]
            },
            options: chartConfig
        });
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Soft UI Dashboard JS -->
<script src="{{ asset('assets-admin/js/soft-ui-dashboard.min.js?v=1.1.0') }}"></script>
<script src="{{ asset('asset/ckeditor/ckeditor.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('editor1')) {
            CKEDITOR.replace('editor1', {
                filebrowserImageBrowseUrl: '{{ asset('asset/kcfinder') }}'
            });
        }
    });
</script>
