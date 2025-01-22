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

<!-- Add DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.tailwind.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endpush
@section('content')
    <div class="flex flex-col gap-4 w-full">
        <x-flash-message />
        
        <!-- Site Information Card -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-xl font-semibold text-gray-900">{{ $site->site_name }}</h1>
                        <div class="flex items-center gap-2 px-3 py-1 rounded-full border" id="connection-status-container">
                            <div id="connection-status" class="w-3 h-3 rounded-full bg-red-500"></div>
                            <span id="connection-status-text" class="text-sm font-medium text-red-600">Disconnected</span>
                        </div>
                    </div>
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
                <div class="flex-1 bg-gray-50 p-4 rounded-lg">
                    <span class="text-sm text-gray-600">Totalizer</span>
                    <div class="text-xl font-semibold mt-1">
                        <span id="totalizer-value">{{ $site->latest_monitoring?->totalizer ?? 'N/A' }}</span>
                        <span class="text-sm text-gray-600">m³</span>
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
                    <div class="flex gap-2">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" value="ph" class="parameter-checkbox" checked>
                            <span>pH</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" value="tss" class="parameter-checkbox" checked>
                            <span>TSS</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" value="nh3n" class="parameter-checkbox" checked>
                            <span>NH3N</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" value="cod" class="parameter-checkbox" checked>
                            <span>COD</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" value="debit" class="parameter-checkbox" checked>
                            <span>Debit</span>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="checkbox" value="totalizer" class="parameter-checkbox" checked>
                            <span>Totalizer</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="relative h-[400px]">
                <!-- Add loading overlay -->
                <div id="chart-loading" class="absolute inset-0 bg-white bg-opacity-75 flex items-center justify-center z-10">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 border-2 border-gray-300 border-t-pink-500 rounded-full animate-spin"></div>
                        <span class="text-gray-600">Loading data...</span>
                    </div>
                </div>
                <canvas id="trendingChart"></canvas>
            </div>
        </div>

        <!-- Historical Data Table -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Historical Data</h2>
            <div class=" w-full">
                <table class="w-full table-fixed divide-y divide-gray-200" id="historical-table">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Timestamp</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">pH</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">TSS (mg/L)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NH3N (mg/L)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">COD (mg/L)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Debit (m³/s)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Totalizer (m³)</th>
                        </tr>
                    </thead>
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

<!-- Socket.IO Client -->
<script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>

<!-- Add Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- Add DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

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

    // Add event listener for date range changes
    $('#daterange').on('apply.daterangepicker', function(ev, picker) {
        updateChart();
    });

    // Initialize trending chart with multiple datasets
    const ctx = document.getElementById('trendingChart').getContext('2d');
    const parameterColors = {
        ph: { border: 'rgb(224, 49, 157)', background: 'rgba(224, 49, 157, 0.1)' },
        tss: { border: 'rgb(59, 130, 246)', background: 'rgba(59, 130, 246, 0.1)' },
        nh3n: { border: 'rgb(16, 185, 129)', background: 'rgba(16, 185, 129, 0.1)' },
        cod: { border: 'rgb(245, 158, 11)', background: 'rgba(245, 158, 11, 0.1)' },
        debit: { border: 'rgb(139, 92, 246)', background: 'rgba(139, 92, 246, 0.1)' },
        totalizer: { border: 'rgb(236, 72, 153)', background: 'rgba(236, 72, 153, 0.1)' }
    };

    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: []
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
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

    // Update chart data function
    async function updateChart() {
        const chartLoading = document.getElementById('chart-loading');
        chartLoading.style.display = 'flex'; // Show loading

        const dates = $('#daterange').data('daterangepicker');
        const selectedParameters = Array.from(document.querySelectorAll('.parameter-checkbox:checked')).map(cb => cb.value);
        
        try {
            const response = await axios.get(`/api/monitoring-data`, {
                params: {
                    start_date: dates.startDate.format('YYYY-MM-DD HH:mm:ss'),
                    end_date: dates.endDate.format('YYYY-MM-DD HH:mm:ss'),
                    token: "{{ $site->site_token }}"
                }
            });

            const data = response.data.data;
            
            // Update chart data
            chart.data.labels = data.map(item => moment(item.datetime_client_formated).format('YYYY-MM-DD HH:mm:ss'));
            
            // Clear existing datasets
            chart.data.datasets = [];
            
            // Create a dataset for each selected parameter
            selectedParameters.forEach(parameter => {
                chart.data.datasets.push({
                    label: parameter.toUpperCase(),
                    data: data.map(item => parseFloat(item[parameter])),
                    borderColor: parameterColors[parameter].border,
                    backgroundColor: parameterColors[parameter].background,
                    fill: true,
                    tension: 0.4
                });
            });
            
            chart.update();

            // Update DataTable with the same data
            historicalTable.clear().rows.add(data).draw();
            
        } catch (error) {
            console.error('Error fetching chart data:', error);
        } finally {
            chartLoading.style.display = 'none'; // Hide loading
        }
    }

    // Add event listener for parameter checkboxes
    document.querySelectorAll('.parameter-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateChart);
    });

    // Initialize DataTable
    const historicalTable = $('#historical-table').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        pageLength: 10,
        data: [], // Start with empty data
        columns: [
            { 
                data: 'datetime_client_formated',
                name: 'datetime_client_formated',
                searchable: true,
                render: function(data) {
                    return moment(data).format('YYYY-MM-DD HH:mm:ss');
                }
            },
            { data: 'ph', name: 'ph', searchable: true },
            { data: 'tss', name: 'tss', searchable: true },
            { data: 'nh3n', name: 'nh3n', searchable: true },
            { data: 'cod', name: 'cod', searchable: true },
            { data: 'debit', name: 'debit', searchable: true },
            { data: 'totalizer', name: 'totalizer', searchable: true }
        ],
        order: [[0, 'desc']],
        dom: "<'flex flex-col sm:flex-row items-center justify-between'<'flex items-center'l><'flex items-center'f>>" +
             "<'overflow-x-auto'tr>" +
             "<'flex flex-col sm:flex-row items-center justify-between mt-4'<'flex-1 text-sm text-gray-700'i><'flex items-center'p>>",
        language: {
            search: "",
            searchPlaceholder: "Search records...",
            lengthMenu: "_MENU_ per page",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "Showing 0 to 0 of 0 entries",
            infoFiltered: "(filtered from _MAX_ total entries)",
            zeroRecords: "No matching records found",
            emptyTable: "No data available",
            paginate: {
                first: '«',
                previous: '‹',
                next: '›',
                last: '»'
            },
            processing: '<div class="flex items-center gap-2"><div class="w-6 h-6 border-2 border-gray-300 border-t-pink-500 rounded-full animate-spin"></div><span>Processing...</span></div>'
        },
        drawCallback: function() {
            // Pagination container
            $('.dataTables_paginate').addClass('flex gap-1 items-center');
            
            // Style all pagination buttons
            $('.paginate_button').each(function() {
                $(this)
                    .removeClass()
                    .addClass('paginate_button relative inline-flex items-center px-3 py-2 text-sm font-medium border cursor-pointer rounded')
                    .not('.current, .disabled')
                    .addClass('bg-white text-gray-700 border-gray-300 hover:bg-gray-50');
            });
            
            // Style current/active page
            $('.paginate_button.current').addClass('bg-pink-500 text-white border-pink-500 hover:bg-pink-600');
            
            // Style disabled buttons
            $('.paginate_button.disabled').addClass('bg-gray-100 text-gray-400 cursor-not-allowed');
            
            // Style the length selection
            $('.dataTables_length select').addClass('block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm');
            
            // Style the search input
            $('.dataTables_filter input').addClass('block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500 sm:text-sm');
            
            // Info text styling
            $('.dataTables_info').addClass('text-sm text-gray-700 py-2');
            
            // Processing indicator styling
            $('.dataTables_processing').addClass('bg-white bg-opacity-80 flex items-center justify-center absolute z-50 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 px-4 py-2 rounded-lg shadow-sm');
        },
        initComplete: function() {
            // Enhance search input
            const searchInput = $('.dataTables_filter input');
            searchInput
                .off() // Remove existing events
                .on('input', debounce(function() {
                    historicalTable.search(this.value).draw();
                }, 500)); // Debounce search for better performance
        }
    });

    // Debounce function to limit how often search is performed
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initial updates
    updateChart();

    // Initialize Socket.IO connection
    const socket = io("{{ env('WEBSOCKET_SERVER_URL') }}", {
        transports: ['websocket']
    });

    // Update connection status handlers
    socket.on('connect', () => {
        console.log('Socket.IO Connected successfully');
        const statusIndicator = document.getElementById('connection-status');
        const statusText = document.getElementById('connection-status-text');
        const container = document.getElementById('connection-status-container');
        
        statusIndicator.classList.remove('bg-red-500');
        statusIndicator.classList.add('bg-green-500');
        
        statusText.classList.remove('text-red-600');
        statusText.classList.add('text-green-600');
        statusText.textContent = 'Connected';
        
        container.title = 'WebSocket Connected';
    });

    socket.on('disconnect', () => {
        console.log('Socket.IO Disconnected');
        const statusIndicator = document.getElementById('connection-status');
        const statusText = document.getElementById('connection-status-text');
        const container = document.getElementById('connection-status-container');
        
        statusIndicator.classList.remove('bg-green-500');
        statusIndicator.classList.add('bg-red-500');
        
        statusText.classList.remove('text-green-600');
        statusText.classList.add('text-red-600');
        statusText.textContent = 'Disconnected';
        
        container.title = 'WebSocket Disconnected';
    });

    // Listen for monitoring updates
    socket.on('realtime_values', (message) => {
        console.log('Received realtime values:', message.data);
        const data = message.data;

        // Update real-time values
        if (data.token === "{{ $site->site_token }}") {
            document.getElementById('ph-value').textContent = data.pH;
            document.getElementById('tss-value').textContent = data.tss;
            document.getElementById('nh3n-value').textContent = data.nh3n;
            document.getElementById('cod-value').textContent = data.cod;
            document.getElementById('debit-value').textContent = data.debit;
            document.getElementById('totalizer-value').textContent = data.totalizer;
        }
    });
</script>
@endpush
