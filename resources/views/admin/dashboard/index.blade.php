@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 class="fw-bold text-white mb-1">Executive Dashboard</h4>
        <span class="text-muted small">Ringkasan performa finansial, volume transaksi, dan inventaris TheHoodZ.</span>
    </div>
    <div class="d-flex gap-2">
        <span class="badge border rounded-pill px-3 py-2 text-white" style="background-color: var(--admin-bg-subtle); border-color: var(--admin-border) !important;">
            <i class="bi bi-calendar3 me-1 text-emerald"></i> {{ date('d M Y') }}
        </span>
    </div>
</div>

@include('admin.dashboard.partials.summary-cards')
@include('admin.dashboard.partials.charts')
@include('admin.dashboard.partials.recent-tables')
@endsection

@push('scripts')
<script>
    // Revenue Line Chart
    const revCtx = document.getElementById('revenueChartCanvas').getContext('2d');
    const revGradient = revCtx.createLinearGradient(0, 0, 0, 250);
    revGradient.addColorStop(0, 'rgba(255, 255, 255, 0.12)');
    revGradient.addColorStop(1, 'rgba(18, 18, 21, 0)');

    new Chart(revCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($revenueChart['labels']) !!},
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: {!! json_encode($revenueChart['data']) !!},
                borderColor: '#E4E4E7',
                borderWidth: 2,
                backgroundColor: revGradient,
                fill: true,
                tension: 0.35,
                pointBackgroundColor: '#10B981',
                pointBorderColor: '#FFF',
                pointRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#18181C',
                    borderColor: '#222226',
                    borderWidth: 1,
                    titleColor: '#FFF',
                    bodyColor: '#10B981',
                    callbacks: {
                        label: function(context) {
                            return 'Revenue: Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#71717A', font: { size: 11 } }
                },
                y: {
                    grid: { color: '#1F1F24' },
                    ticks: {
                        color: '#71717A',
                        font: { size: 11 },
                        callback: function(val) { return 'Rp ' + (val/1000).toLocaleString('id-ID') + 'k'; }
                    }
                }
            }
        }
    });

    // Stock Doughnut Chart
    const stockCtx = document.getElementById('stockChartCanvas').getContext('2d');
    new Chart(stockCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($stockChart['labels']) !!},
            datasets: [{
                data: {!! json_encode($stockChart['data']) !!},
                backgroundColor: ['#D4FF00', '#10B981', '#60A5FA', '#A78BFA'],
                borderColor: '#121215',
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#A1A1AA', boxWidth: 12, font: { size: 11 } }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endpush
