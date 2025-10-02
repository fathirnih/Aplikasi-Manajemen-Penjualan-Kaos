<!-- resources/views/reports/sales.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2>Laporan Penjualan</h2>
            
            <!-- Filter Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('reports.sales') }}" class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" name="start_date" 
                                   value="{{ request('start_date', $startDate->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" name="end_date" 
                                   value="{{ request('end_date', $endDate->format('Y-m-d')) }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label"> </label>
                            <button type="submit" class="btn btn-primary d-block">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h4>
                                    <p class="mb-0">Total Pendapatan</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-money-bill-wave fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['total_invoices'] }}</h4>
                                    <p class="mb-0">Total Invoice</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-file-invoice fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['paid_invoices'] }}</h4>
                                    <p class="mb-0">Invoice Lunas</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>{{ $stats['pending_invoices'] }}</h4>
                                    <p class="mb-0">Invoice Pending</p>
                                </div>
                                <div class="align-self-center">
                                    <i class="fas fa-clock fa-2x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Grafik Penjualan Bulanan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Produk Terlaris</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="productsChart" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(salesCtx, {
        type: 'line',
        data: {
            labels: @json($monthlySales->pluck('month')->map(function($month) { return date('F', mktime(0, 0, 0, $month, 1)); })),
            datasets: [{
                label: 'Penjualan (Rp)',
                data: @json($monthlySales->pluck('total')),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Penjualan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Products Chart
    const productsCtx = document.getElementById('productsChart').getContext('2d');
    const productsChart = new Chart(productsCtx, {
        type: 'doughnut',
        data: {
            labels: @json($topProducts->pluck('product_name')),
            datasets: [{
                data: @json($topProducts->pluck('total_sold')),
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', 
                    '#9966FF', '#FF9F40', '#FF6384', '#C9CBCF'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed + ' terjual';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection