@extends('monitoring.partials.app')

@push('styles')
<style>
    .tab-btn {
        position: relative;
        display: flex;
        align-items: center;
        color: rgb(107, 114, 128);
        white-space: nowrap;
        padding: 1rem 0.75rem;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 200ms ease-in-out;
        border: 1px solid rgb(229, 231, 235);
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
        margin: 0 0.25rem;
    }
    
    .active-tab {
        color: rgb(17, 24, 39);
        border-bottom: 3px solid #E0319D;
        background-color: white;
    }
    
    .tab-content {
        transition: all 300ms ease-in-out;
    }
    
    .tab-btn:hover {
        background-color: rgb(249, 250, 251);
    }

    .custom-popup .leaflet-popup-content-wrapper {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
    }
    
    .custom-popup .leaflet-popup-content {
        margin: 0;
        min-width: 280px;
    }
    
    .custom-popup .leaflet-popup-tip {
        background: rgba(255, 255, 255, 0.95);
    }

    /* Add fullscreen button styles */
    .leaflet-control-fullscreen {
        position: relative;
        float: left;
    }
    
    .leaflet-control-fullscreen a {
        background: #fff url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxwYXRoIGQ9Ik04IDN2M2EyIDIgMCAwIDEtMiAySDN2MTRoMTR2LTNoMmEyIDIgMCAwIDAgMi0yVjNoLTEzeiI+PC9wYXRoPjxwYXRoIGQ9Ik0xOSAzdjE0aC0xNCI+PC9wYXRoPjwvc3ZnPg==') no-repeat center;
        background-size: 16px;
        border: 2px solid rgba(0,0,0,0.2);
        border-radius: 4px;
        width: 36px;
        height: 36px;
        line-height: 36px;
        display: block;
        text-align: center;
        text-decoration: none;
        color: black;
    }
    
    .leaflet-control-fullscreen a:hover {
        background-color: #f4f4f4;
    }

    /* Style for fullscreen mode */
    .leaflet-pseudo-fullscreen {
        position: fixed !important;
        width: 100% !important;
        height: 100% !important;
        top: 0 !important;
        left: 0 !important;
        z-index: 99999;
    }
</style>

<!-- Add Leaflet Fullscreen CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/2.4.0/Control.FullScreen.css" />

<!-- Add Date Range Picker CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush
@section('content')
    <div class="flex flex-col gap-4 w-full">
        <x-flash-message />
        
        <!-- Site Information Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-xl font-semibold text-gray-900">{{ $site->site_name }}</h1>
                    <p class="text-sm text-gray-600">{{ $site->site_address }}</p>
                </div>
                <span class="px-3 py-1 text-xs {{ $site->site_status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full">
                    {{ $site->site_status ? 'Active' : 'Inactive' }}
                </span>
            </div>

            <!-- Current Monitoring Values -->
            <div class="flex flex-wrap gap-4 mt-4">
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <span class="text-sm text-gray-600">pH</span>
                    <div class="text-xl font-semibold mt-1" id="ph-value">{{ $site->latest_monitoring?->ph ?? 'N/A' }}</div>
                </div>
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <span class="text-sm text-gray-600">TSS</span>
                    <div class="text-xl font-semibold mt-1">
                        <span id="tss-value">{{ $site->latest_monitoring?->tss ?? 'N/A' }}</span>
                        <span class="text-sm text-gray-600">mg/L</span>
                    </div>
                </div>
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <span class="text-sm text-gray-600">NH3N</span>
                    <div class="text-xl font-semibold mt-1">
                        <span id="nh3n-value">{{ $site->latest_monitoring?->nh3n ?? 'N/A' }}</span>
                        <span class="text-sm text-gray-600">mg/L</span>
                    </div>
                </div>
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <span class="text-sm text-gray-600">COD</span>
                    <div class="text-xl font-semibold mt-1">
                        <span id="cod-value">{{ $site->latest_monitoring?->cod ?? 'N/A' }}</span>
                        <span class="text-sm text-gray-600">mg/L</span>
                    </div>
                </div>
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <span class="text-sm text-gray-600">Debit</span>
                    <div class="text-xl font-semibold mt-1">
                        <span id="debit-value">{{ $site->latest_monitoring?->debit ?? 'N/A' }}</span>
                        <span class="text-sm text-gray-600">m³/s</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Trending Chart Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Parameter Trending</h2>
                <div class="flex gap-2">
                    <input type="text" id="daterange" class="px-4 py-2 text-sm border border-gray-300 rounded-lg" />
                    <select id="parameter-select" class="px-4 py-2 text-sm border border-gray-300 rounded-lg">
                        <option value="ph">pH</option>
                        <option value="tss">TSS</option>
                        <option value="nh3n">NH3N</option>
                        <option value="cod">COD</option>
                        <option value="debit">Debit</option>
                    </select>
                </div>
            </div>
            <div class="h-[400px]">
                <canvas id="trendingChart"></canvas>
            </div>
        </div>

        <!-- Historical Data Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Historical Data</h2>
            <div class="overflow-x-auto w-full">
                <table class="w-full table-fixed divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Timestamp</th>
                            <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">pH</th>
                            <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">TSS (mg/L)</th>
                            <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NH3N (mg/L)</th>
                            <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">COD (mg/L)</th>
                            <th class="w-1/6 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Debit (m³/s)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="historical-data">
                        <!-- Data will be populated via JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Add required JS libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    // Initialize date range picker
    $('#daterange').daterangepicker({
        startDate: moment().subtract(7, 'days'),
        endDate: moment(),
        ranges: {
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    // Generate dummy data
    function generateDummyData(startDate, endDate, parameter) {
        const data = [];
        const current = moment(startDate);
        const ranges = {
            ph: { min: 6, max: 9 },
            tss: { min: 20, max: 100 },
            nh3n: { min: 0.5, max: 5 },
            cod: { min: 50, max: 200 },
            debit: { min: 0.5, max: 2.5 }
        };

        while (current <= moment(endDate)) {
            const value = Math.random() * (ranges[parameter].max - ranges[parameter].min) + ranges[parameter].min;
            data.push({
                timestamp: current.format('YYYY-MM-DD HH:mm:ss'),
                value: parseFloat(value.toFixed(2))
            });
            current.add(4, 'hours');
        }
        return data;
    }

    // Initialize trending chart
    const ctx = document.getElementById('trendingChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Parameter Value',
                data: [],
                borderColor: 'rgb(224, 49, 157)',
                backgroundColor: 'rgba(224, 49, 157, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Parameter Trending'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Function to update chart data
    function updateChart() {
        const dates = $('#daterange').data('daterangepicker');
        const parameter = $('#parameter-select').val();
        const data = generateDummyData(dates.startDate, dates.endDate, parameter);

        chart.data.labels = data.map(item => moment(item.timestamp).format('DD/MM/YY HH:mm'));
        chart.data.datasets[0].data = data.map(item => item.value);
        chart.data.datasets[0].label = parameter.toUpperCase();
        chart.update();
    }

    // Function to update historical data table
    function updateTable() {
        const dates = $('#daterange').data('daterangepicker');
        const parameters = ['ph', 'tss', 'nh3n', 'cod', 'debit'];
        const tableData = [];
        
        // Generate data for each timestamp
        const current = moment(dates.startDate);
        while (current <= moment(dates.endDate)) {
            const row = {
                timestamp: current.format('YYYY-MM-DD HH:mm:ss'),
                values: {}
            };
            
            parameters.forEach(param => {
                const range = {
                    ph: { min: 6, max: 9 },
                    tss: { min: 20, max: 100 },
                    nh3n: { min: 0.5, max: 5 },
                    cod: { min: 50, max: 200 },
                    debit: { min: 0.5, max: 2.5 }
                };
                row.values[param] = (Math.random() * (range[param].max - range[param].min) + range[param].min).toFixed(2);
            });
            
            tableData.push(row);
            current.add(4, 'hours');
        }

        // Update table HTML
        const tbody = $('#historical-data');
        tbody.empty();
        
        tableData.forEach(row => {
            tbody.append(`
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm text-gray-500">${moment(row.timestamp).format('DD/MM/YY HH:mm')}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${row.values.ph}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${row.values.tss}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${row.values.nh3n}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${row.values.cod}</td>
                    <td class="px-6 py-4 text-sm text-gray-900">${row.values.debit}</td>
                </tr>
            `);
        });
    }

    // Event listeners for date range and parameter changes
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        updateChart();
        updateTable();
    });

    $('#parameter-select').on('change', function() {
        updateChart();
    });

    // Initial updates
    updateChart();
    updateTable();

    // Simulate real-time updates every 30 seconds
    setInterval(() => {
        const parameters = ['ph', 'tss', 'nh3n', 'cod', 'debit'];
        parameters.forEach(param => {
            const range = {
                ph: { min: 6, max: 9 },
                tss: { min: 20, max: 100 },
                nh3n: { min: 0.5, max: 5 },
                cod: { min: 50, max: 200 },
                debit: { min: 0.5, max: 2.5 }
            };
            const value = (Math.random() * (range[param].max - range[param].min) + range[param].min).toFixed(2);
            $(`#${param}-value`).text(value);
        });
    }, 1000);
</script>
@endpush
