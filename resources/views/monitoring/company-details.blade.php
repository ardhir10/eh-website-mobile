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
@endpush
@section('content')
    <div class="flex flex-col gap-4 w-full">
        <x-flash-message />
        {{-- Title Info --}}
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div class="flex flex-col gap-1">
                <div class="flex items-center gap-3">
                    <h1 class="mt-2 text-xl font-semibold text-gray-900">{{ $company->company_name }} - Sites Monitoring</h1>
                    <div class="flex items-center gap-2 px-3 py-1 rounded-full border" id="connection-status-container">
                        <div id="connection-status" class="w-3 h-3 rounded-full bg-red-500"></div>
                        <span id="connection-status-text" class="text-sm font-medium text-red-600">Disconnected</span>
                    </div>
                </div>
                <p class="mt-0.5 text-xs text-gray-600">View detailed monitoring parameters for each site</p>
            </div>
            
            <!-- Search Input -->
            <div class="flex gap-2">
                <input 
                    type="text" 
                    id="site-search" 
                    placeholder="Search sites..." 
                    class="w-full sm:w-64 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 focus:border-transparent"
                    onkeyup="searchSites()"
                >
                <button 
                    onclick="showAllSites()" 
                    class="px-4 text-nowrap py-2 text-sm font-medium text-white bg-pink-600 rounded-lg hover:bg-pink-700 focus:outline-none focus:ring-2 focus:ring-pink-500 focus:ring-offset-2"
                >
                    Show All
                </button>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div class="border-b border-gray-200 ">
            <nav class="flex space-x-2" aria-label="Tabs">
                <button onclick="switchTab('grid')" class="tab-btn active-tab" id="grid-tab">
                    <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Grid View
                </button>
                <button onclick="switchTab('map')" class="tab-btn" id="map-tab">
                    <svg class="w-5 h-5 mr-2 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    Map View
                </button>
            </nav>
        </div>

        <!-- Grid View -->
        <div id="grid-view" class="tab-content">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                @foreach($company->sitesActive as $site)
                    <div class="bg-white rounded-lg shadow-md p-6 site-card" 
                         data-search="{{ strtolower($site->site_name) }} {{ strtolower($site->site_address) }}">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-700">{{ $site->site_name }}</h3>
                                <p class="text-sm text-gray-500">{{ $site->site_address }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 text-xs {{ $site->site_status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full">
                                    {{ $site->site_status ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 text-sm">
                            <!-- pH Parameter -->
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500">pH:</span>
                                <span class="font-semibold" id="ph-{{ $site->site_token }}">{{ $site->latest_monitoring?->ph ?? 'N/A' }}</span>
                            </div>

                            <!-- TSS Parameter -->
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500">TSS:</span>
                                <span class="font-semibold" id="tss-{{ $site->site_token }}">{{ $site->latest_monitoring?->tss ?? 'N/A' }}</span>
                                <span>mg/L</span>
                            </div>

                            <!-- NH3N Parameter -->
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500">NH3N:</span>
                                <span class="font-semibold" id="nh3n-{{ $site->site_token }}">{{ $site->latest_monitoring?->nh3n ?? 'N/A' }}</span>
                                <span>mg/L</span>
                            </div>

                            <!-- COD Parameter -->
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500">COD:</span>
                                <span class="font-semibold" id="cod-{{ $site->site_token }}">{{ $site->latest_monitoring?->cod ?? 'N/A' }}</span>
                                <span>mg/L</span>
                            </div>

                            <!-- Debit Parameter -->
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-500">Debit:</span>
                                <span class="font-semibold" id="debit-{{ $site->site_token }}">{{ $site->latest_monitoring?->debit ?? 'N/A' }}</span>
                                <span>m³/s</span>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <a href="{{ route('monitoring.site-details', $site->id) }}" 
                               class="text-sm text-pink-600 hover:text-pink-700 font-medium">
                                View Details →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Map View -->
        <div id="map-view" class="tab-content hidden">
            <div id="map" class="h-[600px] w-full rounded-lg"></div>
        </div>
    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endsection

@push('scripts')
    <!-- Socket.IO Client -->
    <script src="https://cdn.socket.io/4.8.1/socket.io.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" defer></script>
    <!-- Add Leaflet Fullscreen JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.fullscreen/2.4.0/Control.FullScreen.min.js" defer></script>
    
    <script>
        // Inisialisasi map hanya ketika tab map aktif
        let map = null;
        
        function initializeMap() {
            if (map !== null) return; // Prevent multiple initializations
            
            map = L.map('map', {
                fullscreenControl: true,
                fullscreenControlOptions: {
                    position: 'topleft',
                    title: 'Show me the fullscreen !',
                    titleCancel: 'Exit fullscreen mode'
                }
            });
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 19,
                minZoom: 5,
                tileSize: 256,
                zoomOffset: 0
            }).addTo(map);

            // Add markers for each site
            const sites = @json($company->sitesActive);
            const markers = [];
            sites.forEach(site => {
                const marker = L.marker([site.site_latitude || -6.200000, site.site_longitude || 106.816666])
                    .bindPopup(`
                        <div class="p-1.5" data-search="${site.site_name.toLowerCase()} ${site.site_address.toLowerCase()}">
                            <div class="border-b border-gray-200 pb-1 mb-1">
                                <h3 class="font-semibold text-[13px] text-gray-800">${site.site_name}</h3>
                                <p class="text-[11px] text-gray-500">${site.site_address}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-x-3 gap-y-0.5 text-[11px]">
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">pH:</span>
                                    <span class="font-medium" id="map-ph-${site.site_token}">${site.latest_monitoring?.ph || 'N/A'}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">TSS:</span>
                                    <span class="font-medium"><span id="map-tss-${site.site_token}">${site.latest_monitoring?.tss || 'N/A'}</span> mg/L</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">NH3N:</span>
                                    <span class="font-medium"><span id="map-nh3n-${site.site_token}">${site.latest_monitoring?.nh3n || 'N/A'}</span> mg/L</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-gray-600">COD:</span>
                                    <span class="font-medium"><span id="map-cod-${site.site_token}">${site.latest_monitoring?.cod || 'N/A'}</span> mg/L</span>
                                </div>
                                <div class="flex items-center justify-between col-span-2">
                                    <span class="text-gray-600">Debit:</span>
                                    <span class="font-medium"><span id="map-debit-${site.site_token}">${site.latest_monitoring?.debit || 'N/A'}</span> m³/s</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 text-right">
                            <a href="/monitoring/site-details/${site.id}" 
                               class="text-[11px] text-pink-600 hover:text-pink-700 font-medium">
                                View Details →
                            </a>
                        </div>
                    `, {
                        closeButton: false,
                        className: 'custom-popup',
                        autoClose: false
                    });
                markers.push(marker);
                marker.addTo(map);
                marker.openPopup(); // This will open the popup when marker is added
            });

            // Create a feature group and fit bounds
            const group = new L.featureGroup(markers);
            map.fitBounds(group.getBounds(), {
                padding: [50, 50]
            });
        }

        // Modify switchTab function
        function switchTab(tab) {
            const gridView = document.getElementById('grid-view');
            const mapView = document.getElementById('map-view');
            const gridTab = document.getElementById('grid-tab');
            const mapTab = document.getElementById('map-tab');

            if (tab === 'grid') {
                gridView.classList.remove('hidden');
                mapView.classList.add('hidden');
                gridTab.classList.add('active-tab');
                mapTab.classList.remove('active-tab');
            } else {
                gridView.classList.add('hidden');
                mapView.classList.remove('hidden');
                gridTab.classList.remove('active-tab');
                mapTab.classList.add('active-tab');
                initializeMap(); // Initialize map only when map tab is active
            }
        }

        // Initialize Socket.IO connection
        const socket = io("{{ env('WEBSOCKET_SERVER_URL') }}", {
            transports: ['websocket']
        });

        // on connect
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
            console.log('Received realtime values:', message);
            const data = message.data;  // Extract data from message
            
            // Find elements with matching token and update values
            const parameters = {
                'ph': data.pH,
                'tss': data.tss,
                'nh3n': data.nh3n,
                'cod': data.cod,
                'debit': data.debit
            };

            console.log(parameters);

            Object.entries(parameters).forEach(([param, value]) => {
                const gridElement = document.getElementById(`${param}-${data.token}`);
                const mapElement = document.getElementById(`map-${param}-${data.token}`);
                
                if (gridElement) gridElement.textContent = value;
                if (mapElement) mapElement.textContent = value;
            });
        });

        function searchSites() {
            const searchInput = document.getElementById('site-search');
            const searchTerm = searchInput.value.toLowerCase();
            const siteCards = document.getElementsByClassName('site-card');
            const mapView = document.getElementById('map-view');
            
            Array.from(siteCards).forEach(card => {
                const searchText = card.getAttribute('data-search');
                if (searchText.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });

            // Update map markers if map is visible
            if (!mapView.classList.contains('hidden') && map) {
                map.eachLayer((layer) => {
                    if (layer instanceof L.Marker) {
                        const popupContent = layer.getPopup().getContent();
                        const tempDiv = document.createElement('div');
                        tempDiv.innerHTML = popupContent;
                        const searchText = tempDiv.querySelector('div[data-search]').getAttribute('data-search');
                        
                        if (searchText.includes(searchTerm)) {
                            layer.setOpacity(1);
                            if (searchTerm.length > 0) {
                                layer.openPopup();
                            }
                        } else {
                            layer.setOpacity(0.2);
                            layer.closePopup();
                        }
                    }
                });
            }
        }

        // Add event listener to clear popups when search is empty
        document.getElementById('site-search').addEventListener('input', function(e) {
            if (e.target.value === '' && map) {
                map.eachLayer((layer) => {
                    if (layer instanceof L.Marker) {
                        layer.setOpacity(1);
                        layer.closePopup();
                    }
                });
            }
        });

        function showAllSites() {
            // Clear search input
            document.getElementById('site-search').value = '';
            
            // Show all site cards
            const siteCards = document.getElementsByClassName('site-card');
            Array.from(siteCards).forEach(card => {
                card.style.display = '';
            });

            // Reset map markers and open all popups if map is visible
            if (map) {
                map.eachLayer((layer) => {
                    if (layer instanceof L.Marker) {
                        layer.setOpacity(1);
                        layer.openPopup(); // Open all popups
                    }
                });
            }
        }
    </script>
@endpush
