@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Page Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600 mt-2">Boshqaruv paneliga xush kelibsiz</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Products Card -->
    <div class="bg-white rounded-lg shadow-md p-6 stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Jami Mahsulotlar</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['products']['total'] }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Faol: {{ $stats['products']['active'] }}</span>
                <span class="text-blue-600 font-medium">{{ $stats['products']['progress'] }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="progress-bar bg-blue-600 h-2 rounded-full" style="width: {{ $stats['products']['progress'] }}%"></div>
            </div>
        </div>
    </div>

    <!-- Orders Card -->
    <div class="bg-white rounded-lg shadow-md p-6 stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Jami Buyurtmalar</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['orders']['total'] }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Yetkazilgan: {{ $stats['orders']['delivered'] }}</span>
                <span class="text-green-600 font-medium">{{ $stats['orders']['progress'] }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="progress-bar bg-green-600 h-2 rounded-full" style="width: {{ $stats['orders']['progress'] }}%"></div>
            </div>
        </div>
    </div>

    <!-- Users Card -->
    <div class="bg-white rounded-lg shadow-md p-6 stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Foydalanuvchilar</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['users']['total'] }}</p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Bu oy: {{ $stats['users']['new_this_month'] }}</span>
                <span class="text-purple-600 font-medium">{{ $stats['users']['progress'] }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="progress-bar bg-purple-600 h-2 rounded-full" style="width: {{ $stats['users']['progress'] }}%"></div>
            </div>
        </div>
    </div>

    <!-- Revenue Card -->
    <div class="bg-white rounded-lg shadow-md p-6 stat-card">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Jami Daromad</p>
                <p class="text-2xl font-bold text-gray-800 mt-1">${{ number_format($stats['revenue']['total'], 2) }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex justify-between text-sm mb-1">
                <span class="text-gray-600">Bu oy: ${{ number_format($stats['revenue']['this_month'], 2) }}</span>
                <span class="text-yellow-600 font-medium">{{ $stats['revenue']['progress'] }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="progress-bar bg-yellow-600 h-2 rounded-full" style="width: {{ $stats['revenue']['progress'] }}%"></div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Daromad Statistikasi</h2>
        <div class="flex space-x-2">
            <button onclick="updateChart('daily')" id="btn-daily" class="px-4 py-2 text-sm font-medium bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors chart-btn">Kunlik</button>
            <button onclick="updateChart('monthly')" id="btn-monthly" class="px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors chart-btn">Oylik</button>
            <button onclick="updateChart('yearly')" id="btn-yearly" class="px-4 py-2 text-sm font-medium bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors chart-btn">Yillik</button>
        </div>
    </div>
    <div id="revenueChart" class="w-full h-80"></div>
</div>

<!-- Recent Orders and Users -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Oxirgi Buyurtmalar</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mijoz</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Summa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentOrders as $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $order->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $order->user->name ?? 'Noma\'lum' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($order->status === 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Buyurtmalar yo\'q</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Barcha buyurtmalarni ko\'rish &rarr;</a>
        </div>
    </div>

    <!-- Recent Users -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-800">Yangi Foydalanuvchilar</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ism</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sana</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($recentUsers as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-indigo-600 font-medium text-sm">{{ substr($user->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-sm text-gray-900">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('d.m.Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500">Foydalanuvchilar yo\'q</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            <a href="#" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Barcha foydalanuvchilarni ko\'rish &rarr;</a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Chart data from PHP
    const dailyStats = @json($dailyStats);
    const monthlyStats = @json($monthlyStats);
    const yearlyStats = @json($yearlyStats);

    let currentChart = null;

    function renderChart(labels, data, title) {
        const options = {
            series: [{
                name: 'Daromad ($)',
                data: data
            }],
            chart: {
                type: 'area',
                height: 320,
                toolbar: {
                    show: false
                }
            },
            colors: ['#4f46e5'],
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.2,
                    stops: [0, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            },
            xaxis: {
                categories: labels,
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return '$' + value.toFixed(0);
                    }
                }
            },
            grid: {
                borderColor: '#e5e7eb',
                strokeDashArray: 4
            },
            tooltip: {
                y: {
                    formatter: function (value) {
                        return '$' + value.toFixed(2);
                    }
                }
            }
        };

        if (currentChart) {
            currentChart.destroy();
        }

        currentChart = new ApexCharts(document.querySelector("#revenueChart"), options);
        currentChart.render();
    }

    function updateChart(type) {
        // Update button styles
        document.querySelectorAll('.chart-btn').forEach(btn => {
            btn.classList.remove('bg-indigo-600', 'text-white');
            btn.classList.add('bg-gray-200', 'text-gray-700');
        });
        document.getElementById('btn-' + type).classList.remove('bg-gray-200', 'text-gray-700');
        document.getElementById('btn-' + type).classList.add('bg-indigo-600', 'text-white');

        // Render chart
        if (type === 'daily') {
            renderChart(dailyStats.labels, dailyStats.data, 'Kunlik Daromad');
        } else if (type === 'monthly') {
            renderChart(monthlyStats.labels, monthlyStats.data, 'Oylik Daromad');
        } else if (type === 'yearly') {
            renderChart(yearlyStats.labels, yearlyStats.data, 'Yillik Daromad');
        }
    }

    // Initial render - daily chart
    renderChart(dailyStats.labels, dailyStats.data, 'Kunlik Daromad');
</script>
@endsection
