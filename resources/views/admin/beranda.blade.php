@extends('admin.layouts.app')

@section('title', 'Dashboard - BPKPAD')

@section('content')
    <div class="container-fluid px-4 py-4">
        <!-- Header Section -->
        <div class="mb-4">
            <h1 class="h2 fw-bold text-success mb-2">Dashboard</h1>
            <p class="text-muted mb-0">Selamat datang di panel administrasi BPKPAD</p>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <!-- Berita Card -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 card-hover"
                    onclick="window.location.href='{{ route('listberita') }}'" style="cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase text-muted fw-bold mb-1 small">Berita</p>
                                <h3 class="fw-bold text-success mb-0">{{ $jumlahBerita }}</h3>
                                <div class="mt-2">
                                    <small class="text-success fw-semibold">+12%</small>
                                    <small class="text-muted ms-1">dari bulan lalu</small>
                                </div>
                            </div>
                            <div class="icon-box bg-primary">
                                <i class="material-symbols-rounded text-white">article</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Halaman Card -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 card-hover"
                    onclick="window.location.href='{{ route('kontenmenu') }}'" style="cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase text-muted fw-bold mb-1 small">Halaman</p>
                                <h3 class="fw-bold text-success mb-0">{{ $jumlahHalaman }}</h3>
                                <div class="mt-2">
                                    <small class="text-success fw-semibold">+8%</small>
                                    <small class="text-muted ms-1">dari bulan lalu</small>
                                </div>
                            </div>
                            <div class="icon-box bg-info">
                                <i class="material-symbols-rounded text-white">description</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agenda Card -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 card-hover"
                    onclick="window.location.href='{{ route('administrator.agenda') }}'" style="cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase text-muted fw-bold mb-1 small">Agenda</p>
                                <h3 class="fw-bold text-success mb-0">{{ $jumlahAgenda }}</h3>
                                <div class="mt-2">
                                    <small class="text-success fw-semibold">+15%</small>
                                    <small class="text-muted ms-1">dari bulan lalu</small>
                                </div>
                            </div>
                            <div class="icon-box bg-success">
                                <i class="material-symbols-rounded text-white">event</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Card -->
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 card-hover"
                    onclick="window.location.href='{{ route('manajemenuser') }}'" style="cursor: pointer;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="text-uppercase text-muted fw-bold mb-1 small">Pengguna</p>
                                <h3 class="fw-bold text-success mb-0">{{ $jumlahUser }}</h3>
                                <div class="mt-2">
                                    <small class="text-success fw-semibold">+5%</small>
                                    <small class="text-muted ms-1">dari bulan lalu</small>
                                </div>
                            </div>
                            <div class="icon-box bg-warning">
                                <i class="material-symbols-rounded text-white">people</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row g-4">
            <!-- Chart Section -->
            <!-- Grafik Kunjungan -->
            <div class="col-xl-8 col-lg-8">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold text-success mb-0">Grafik Kunjungan</h5>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-success active">7 Hari</button>
                                <button type="button" class="btn btn-danger">30 Hari</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="kunjunganChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik Kepuasan Publik -->
            <div class="col-xl-4 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 py-3">
                        <h6 class="fw-bold text-success mb-0">Grafik Kepuasan Publik</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="height: 350px;">
                            <canvas id="kepuasanChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Write Section -->
        <div class="row g-4 mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-gradient-success text-white py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <i class="material-symbols-rounded me-2">edit</i>
                                <h6 class="fw-semibold mb-0">Tulis Berita Cepat</h6>
                            </div>
                            <button type="button" class="btn btn-link text-white p-0" data-bs-toggle="collapse"
                                data-bs-target="#quickWriteForm" aria-expanded="true">
                                <i class="material-symbols-rounded">expand_less</i>
                            </button>
                        </div>
                    </div>

                    <div class="collapse show" id="quickWriteForm">
                        <!-- Success/Error Messages -->
                        @if (session('success'))
                            <div class="mx-3 mt-3">
                                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm"
                                    role="alert">
                                    <div class="d-flex align-items-center">
                                        <i class="material-symbols-rounded text-success me-2">check_circle</i>
                                        <span class="fw-medium">{{ session('success') }}</span>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mx-3 mt-3">
                                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm"
                                    role="alert">
                                    <div class="d-flex align-items-start">
                                        <i class="material-symbols-rounded text-danger me-2 mt-1">error</i>
                                        <div class="flex-grow-1">
                                            @foreach ($errors->all() as $error)
                                                <div class="fw-medium">{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('administrator.beritaCepat') }}" method="POST" class="p-4"
                            id="quickNewsForm">
                            @csrf

                            <!-- Judul Berita -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold text-success">Judul Berita</label>
                                <input type="text" name="judul" class="form-control form-control-modern"
                                    placeholder="Masukkan judul berita..." value="{{ old('judul') }}" required>
                            </div>

                            <!-- Isi Berita -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-success">Isi Berita</label>
                                <textarea id="editor1" name="isi_berita" rows="6" class="form-control form-control-modern"
                                    placeholder="Tulis isi berita di sini...">{{ old('isi_berita') }}</textarea>
                            </div>

                            <!-- Hidden Tag -->
                            <input type="hidden" name="tag" value="">

                            <!-- Tombol Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success btn-modern" id="submitBtn">
                                    <span>Publikasikan</span>
                                    <i class="material-symbols-rounded ms-2">send</i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>




@endsection
@push('styles')
    <style>
        /* Modern Card Styling */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15) !important;
        }

        /* Icon Box */
        .icon-box {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content-center;
            position: relative;
            overflow: hidden;
        }

        .icon-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, rgba(255, 255, 255, 0) 100%);
            border-radius: 16px;
        }

        .icon-box i {
            font-size: 24px;
            position: relative;
            z-index: 1;
        }

        /* Background Gradients */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }

        /* Modern Form Controls */
        .form-control-modern {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            background-color: #f8f9fa;
        }

        .form-control-modern:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background-color: #fff;
        }

        .form-control-modern:hover {
            background-color: #fff;
            border-color: #ced4da;
        }

        /* Modern Button */
        .btn-modern {
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
        }

        /* Chart Container */
        .chart-container {
            position: relative;
            height: 350px;
        }

        /* Card Headers */
        .card-header {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 15px;
                padding-right: 15px;
            }

            .icon-box {
                width: 50px;
                height: 50px;
            }

            .icon-box i {
                font-size: 20px;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Chart Configuration
            const ctx = document.getElementById('kunjunganChart').getContext('2d');

            // Data dari controller
            const chartData = @json($statistikKunjungan);

            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(102, 126, 234, 0.8)');
            gradient.addColorStop(1, 'rgba(102, 126, 234, 0.1)');

            const kunjunganChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Jumlah Pengunjung',
                        data: chartData.data,
                        backgroundColor: gradient,
                        borderColor: 'rgba(102, 126, 234, 1)',
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(33, 37, 41, 0.95)',
                            titleColor: 'white',
                            bodyColor: 'white',
                            borderColor: 'rgba(102, 126, 234, 1)',
                            borderWidth: 1,
                            cornerRadius: 8,
                            displayColors: false,
                            titleFont: {
                                size: 14,
                                weight: '600'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                title: function(tooltipItems) {
                                    return tooltipItems[0].label;
                                },
                                label: function(context) {
                                    return context.parsed.y + ' pengunjung';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d',
                                font: {
                                    size: 12,
                                    weight: '500'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(108, 117, 125, 0.1)',
                                drawBorder: false
                            },
                            border: {
                                display: false
                            },
                            ticks: {
                                color: '#6c757d',
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },
                    animation: {
                        duration: 1200,
                        easing: 'easeOutQuart'
                    }
                }
            });

            // Fungsi untuk update chart
            function updateChart(days) {
                fetch(`/admin/dashboard/statistik?days=${days}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        kunjunganChart.data.labels = data.labels;
                        kunjunganChart.data.datasets[0].data = data.data;
                        kunjunganChart.update();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                    });
            }

            // Event listener untuk tombol periode
            const timeButtons = document.querySelectorAll('.btn-group .btn');
            timeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    timeButtons.forEach(btn => {
                        btn.classList.remove('active', 'btn-primary');
                        btn.classList.add('btn-outline-primary');
                    });
                    this.classList.add('active', 'btn-primary');
                    this.classList.remove('btn-outline-primary');

                    const days = this.textContent.trim() === '7 Hari' ? 7 : 30;
                    updateChart(days);
                });
            });

            // Animasi card
            const cards = document.querySelectorAll('.card-hover');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in');
            });

            // Auto-hide alerts
            setTimeout(() => {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    const bsAlert = new bootstrap.Alert(alert);
                    alert.style.transition = 'opacity 0.5s ease-out';
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        try {
                            bsAlert.close();
                        } catch (e) {
                            alert.remove();
                        }
                    }, 500);
                });
            }, 5000);

            const kepuasanChart = new Chart(document.getElementById('kepuasanChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['😡 Sangat Tidak Puas', '😞 Tidak Puas', '😐 Cukup', '🙂 Puas',
                        '😍 Sangat Puas'
                    ],
                    datasets: [{
                        label: 'Kepuasan Publik',
                        data: @json($statistikKepuasan), // [10, 5, 15, 20, 50] misal
                        backgroundColor: [
                            '#dc3545', '#fd7e14', '#ffc107', '#28a745', '#007bff'
                        ],
                        borderColor: [
                            '#dc3545', '#fd7e14', '#ffc107', '#28a745', '#007bff'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: {
                                    size: 12
                                },
                                color: '#6c757d'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.parsed} responden`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
