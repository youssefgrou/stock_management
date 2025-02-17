@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Products Card -->
        <div class="relative group h-full">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
            <div class="relative bg-white rounded-lg shadow-sm h-full flex flex-col">
                <div class="px-6 py-5 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 rounded-lg bg-blue-50">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Products</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900">{{ $stats['total_items'] }}</div>
                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-blue-600">
                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Increased by</span>
                                        4%
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 rounded-b-lg mt-auto">
                    <div class="text-sm">
                        <a href="{{ route('products.index') }}" class="font-medium text-blue-600 hover:text-blue-700 flex items-center justify-between group">
                            View all products
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Items Card -->
        <div class="relative group h-full">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
            <div class="relative bg-white rounded-lg shadow-sm h-full flex flex-col">
                <div class="px-6 py-5 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 rounded-lg bg-blue-50">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Low Stock Items</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900">{{ $stats['low_stock_items'] }}</div>
                                    @if($stats['low_stock_items'] > 0)
                                        <div class="ml-2 flex items-baseline text-sm font-semibold text-blue-600">
                                            Needs attention
                                        </div>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 rounded-b-lg mt-auto">
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-700 flex items-center justify-between group">
                            View low stock items
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Value Card -->
        <div class="relative group h-full">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
            <div class="relative bg-white rounded-lg shadow-sm h-full flex flex-col">
                <div class="px-6 py-5 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 rounded-lg bg-blue-50">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Value</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900">{{ \App\Helpers\CurrencyHelper::format($stats['total_value']) }}</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 rounded-b-lg mt-auto">
                    <div class="text-sm">
                        <a href="#" class="font-medium text-blue-600 hover:text-blue-700 flex items-center justify-between group">
                            View inventory value
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity Card -->
        <div class="relative group h-full">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-200"></div>
            <div class="relative bg-white rounded-lg shadow-sm h-full flex flex-col">
                <div class="px-6 py-5 flex-grow">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 rounded-lg bg-blue-50">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" />
                            </svg>
                        </div>
                        <div class="ml-5 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 uppercase tracking-wide">Recent Activities</dt>
                                <dd class="flex items-baseline">
                                    <div class="text-2xl font-bold text-gray-900">{{ count($stats['recent_activities']) }}</div>
                                    <div class="ml-2 text-sm text-gray-600">last 24h</div>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 rounded-b-lg mt-auto">
                    <div class="text-sm">
                        <a href="#recent-activity" class="font-medium text-blue-600 hover:text-blue-700 flex items-center justify-between group">
                            View activity
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Stock Levels Chart -->
        <div class="relative group">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25"></div>
            <div class="relative bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Stock Levels</h3>
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="stockLevelsChart" class="h-80"></div>
            </div>
        </div>

        <!-- Stock Movement Chart -->
        <div class="relative group">
            <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25"></div>
            <div class="relative bg-white shadow rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Stock Movement</h3>
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="stockMovementChart" class="h-80"></div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="relative group">
        <div class="absolute -inset-0.5 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg blur opacity-25"></div>
        <div class="relative bg-white shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800">
                    Last 24 hours
                </span>
            </div>
            
            <div class="flow-root">
                <ul role="list" class="-mb-8">
                    @forelse($stats['recent_activities'] as $activity)
                        <li>
                            <div class="relative pb-8">
                                @if(!$loop->last)
                                    <span class="absolute left-4 top-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                @endif
                                <div class="relative flex space-x-3">
                                    <div>
                                        <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                            @if($activity->type === 'in')
                                                <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            @else
                                                <svg class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                                                </svg>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex min-w-0 flex-1 justify-between space-x-4 pt-1.5">
                                        <div>
                                            <p class="text-sm text-gray-500">
                                                {{ $activity->type === 'in' ? 'Added' : 'Removed' }}
                                                <span class="font-medium text-gray-900">{{ $activity->quantity }}</span>
                                                units of
                                                <a href="{{ route('products.show', $activity->product) }}" class="font-medium text-blue-600 hover:text-blue-700">
                                                    {{ $activity->product->name }}
                                                </a>
                                            </p>
                                        </div>
                                        <div class="whitespace-nowrap text-right text-sm text-gray-500">
                                            <time datetime="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</time>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="text-center py-4">
                            <p class="text-sm text-gray-500">No recent activity</p>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Stock Levels Chart
    var stockLevelsOptions = {
        series: [{
            name: 'Stock Level',
            data: @json($stockLevels->pluck('quantity'))
        }],
        chart: {
            type: 'bar',
            height: 320,
            toolbar: {
                show: false
            },
            fontFamily: 'Inter var, sans-serif'
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                borderRadius: 6,
                dataLabels: {
                    position: 'top'
                }
            },
        },
        dataLabels: {
            enabled: true,
            offsetY: -20,
            style: {
                fontSize: '12px',
                fontWeight: '500',
                colors: ['#6B7280']
            }
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: @json($stockLevels->pluck('name')),
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '12px',
                    fontWeight: '500'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '12px',
                    fontWeight: '500'
                }
            }
        },
        fill: {
            opacity: 1,
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                opacityFrom: 1,
                opacityTo: 0.9,
                colorStops: [
                    {
                        offset: 0,
                        color: '#3B82F6',
                        opacity: 1
                    },
                    {
                        offset: 100,
                        color: '#2563EB',
                        opacity: 1
                    }
                ]
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return val + " units"
                }
            },
            theme: 'dark'
        }
    };

    var stockLevelsChart = new ApexCharts(document.querySelector("#stockLevelsChart"), stockLevelsOptions);
    stockLevelsChart.render();

    // Stock Movement Chart
    var stockMovementOptions = {
        series: [{
            name: 'Stock In',
            data: @json($stockMovements->pluck('stock_in'))
        }, {
            name: 'Stock Out',
            data: @json($stockMovements->pluck('stock_out'))
        }],
        chart: {
            height: 320,
            type: 'area',
            toolbar: {
                show: false
            },
            fontFamily: 'Inter var, sans-serif'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [0, 100]
            }
        },
        xaxis: {
            type: 'datetime',
            categories: @json($stockMovements->pluck('date')),
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '12px',
                    fontWeight: '500'
                }
            }
        },
        yaxis: {
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '12px',
                    fontWeight: '500'
                }
            }
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy'
            },
            theme: 'dark'
        },
        colors: ['#3B82F6', '#93C5FD'],
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            labels: {
                colors: '#6B7280'
            }
        }
    };

    var stockMovementChart = new ApexCharts(document.querySelector("#stockMovementChart"), stockMovementOptions);
    stockMovementChart.render();
</script>
@endpush
@endsection
