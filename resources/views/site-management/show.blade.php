@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                <i class="fas fa-building text-gray-400 text-3xl"></i>
            </div>
            <h1 class="text-2xl">{{ $site->site_name }}</h1>
        </div>
        <a href="{{ route('site-management.index') }}" class="px-4 py-2 bg-gray-500 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Site Details Section -->
        <div>
            <div class="grid grid-cols-1 gap-4">
                <div class="border-b pb-4">
                    <h2 class="text-xl font-semibold text-gray-800 text-magenta-2">{{ $site->site_name }}</h2>
                    <p class="text-sm text-gray-600">Company: {{ $site->company->company_name }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Contact Information -->
                    <div class="space-y-3">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Phone Number</h3>
                            <p class="text-gray-800">{{ $site->site_phone }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Email</h3>
                            <p class="text-gray-800">{{ $site->site_email }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Visibility</h3>
                            <p class="text-gray-800">{{ ucfirst($site->site_visibility) }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Status</h3>
                            <p class="text-gray-800">{{ $site->site_status ? 'Active' : 'Inactive' }}</p>
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="space-y-3">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Created At</h3>
                            <p class="text-gray-800">{{ $site->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Last Updated</h3>
                            <p class="text-gray-800">{{ $site->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Site Token</h3>
                            <div class="flex items-center gap-2">
                                <div class="bg-gray-100 p-2 rounded-lg flex-1">
                                    <p class="text-gray-800 break-all font-mono" id="siteToken">{{ $site->site_token }}</p>
                                </div>
                                <button onclick="copyToken()" 
                                        class="px-3 py-2 bg-magenta-2 text-white text-sm rounded-full hover:bg-magenta-3 flex items-center gap-2">
                                    <i class="fas fa-copy"></i>
                                    Copy
                                </button>
                            </div>
                            <div id="copyMessage" class="hidden mt-2 text-sm text-green-600">
                                <i class="fas fa-check-circle"></i> Token Copied successfully!
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="space-y-2">
                    <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Address</h3>
                    <p class="text-gray-800">{{ $site->site_address }}</p>
                </div>

                <!-- Map -->
                <div class="space-y-2">
                    <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Location</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <p class="text-sm text-gray-600">Latitude: <span class="text-gray-800">{{ $site->site_latitude }}</span></p>
                            <p class="text-sm text-gray-600">Longitude: <span class="text-gray-800">{{ $site->site_longitude }}</span></p>
                        </div>
                    </div>
                    <div id="map" class="h-[400px] rounded-lg mt-2"></div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('site-management.edit', $site->id) }}" 
                       class="px-4 py-2 bg-magenta-2 text-white text-sm rounded-full hover:bg-magenta-3 flex items-center gap-2">
                        <i class="fas fa-edit"></i>
                        Edit Site
                    </a>
                    <form action="{{ route('site-management.destroy', $site->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this site?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-gray-400 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2">
                            <i class="fas fa-trash"></i>
                            Delete Site
                        </button>
                    </form>
                </div>
            </div>
        </div>

      
    </div>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    $(document).ready(function() {
        // Get coordinates from the site data or use default Jakarta coordinates
        var lat = {{ $site->site_latitude ?? -6.200000 }};
        var lng = {{ $site->site_longitude ?? 106.816666 }};

        var map = L.map('map', {
            tap: true,
            touchZoom: true
        }).setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Add a non-draggable marker
        L.marker([lat, lng]).addTo(map);
    });

    // Existing copy token function
    function copyToken() {
        const tokenText = document.getElementById('siteToken').innerText;
        const copyMessage = document.getElementById('copyMessage');
        
        navigator.clipboard.writeText(tokenText).then(() => {
            copyMessage.classList.remove('hidden');
            setTimeout(() => {
                copyMessage.classList.add('hidden');
            }, 3000); // Message will disappear after 3 seconds
        }).catch(err => {
            console.error('Failed to copy token:', err);
        });
    }
</script>
@endpush 