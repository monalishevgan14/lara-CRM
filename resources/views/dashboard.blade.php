@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')


<!-- ===================== -->
<!-- STAT CARDS -->
<!-- ===================== -->
<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4">
            <h3 class="fw-bold">{{ $totalUsers }}</h3>
            <p class="text-muted mb-0">Total Users</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4">
            <h3 class="fw-bold">{{ $totalOrders }}</h3>
            <p class="text-muted mb-0">Total Orders</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0 p-4">
            <h3 class="fw-bold">₹ {{ number_format($totalRevenue, 2) }}</h3>
            <p class="text-muted mb-0">Total Revenue</p>
        </div>
    </div>

</div>


<!-- ===================== -->
<!-- CHARTS -->
<!-- ===================== -->
<div class="row g-4 mb-5">

    <!-- Revenue Chart -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0 p-4">
            <h6 class="mb-3 fw-semibold">Monthly Revenue</h6>
            <div style="height:280px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Orders Chart -->
    <div class="col-md-6">
        <div class="card shadow-sm border-0 p-4">
            <h6 class="mb-3 fw-semibold">Monthly Orders</h6>
            <div style="height:280px;">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>

</div>


<!-- ===================== -->
<!-- LATEST ORDERS -->
<!-- ===================== -->
<h5 class="mb-3 fw-semibold">Latest Orders</h5>

<div class="card shadow-sm border-0 mb-5">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Total Amount</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($latestOrders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>₹ {{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- ===================== -->
<!-- TOP SELLING PRODUCTS -->
<!-- ===================== -->
<h5 class="mb-3 fw-semibold">Top Selling Products</h5>

<div class="card shadow-sm border-0 mb-5">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Product ID</th>
                    <th>Total Sold</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topProducts as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->total_sold }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


@push('scripts')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const revenueData = @json($monthlyRevenue);
const ordersData = @json($monthlyOrders);

const months = [
    'Jan','Feb','Mar','Apr','May','Jun',
    'Jul','Aug','Sep','Oct','Nov','Dec'
];

let revenueArray = [];
let ordersArray = [];

for(let i = 1; i <= 12; i++) {
    revenueArray.push(revenueData[i] ?? 0);
    ordersArray.push(ordersData[i] ?? 0);
}

// ================= Revenue Chart =================
new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: months,
        datasets: [{
            label: 'Revenue (₹)',
            data: revenueArray,
            backgroundColor: '#4f46e5',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        }
    }
});

// ================= Orders Chart =================
new Chart(document.getElementById('ordersChart'), {
    type: 'line',
    data: {
        labels: months,
        datasets: [{
            label: 'Orders',
            data: ordersArray,
            borderColor: '#ef4444',
            backgroundColor: 'rgba(239,68,68,0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

@endpush
