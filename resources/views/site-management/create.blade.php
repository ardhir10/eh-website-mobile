@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl">Create Site</h1>
        <a href="{{ route('site-management.index') }}" class="px-4 py-2 bg-gray-500 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
    </div>

    {{-- Flash Message --}}
    <x-flash-message />
    
    <form action="{{ route('site-management.store') }}" method="POST" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col gap-2">
                <label for="company_id" class="text-sm font-medium text-gray-700">Company</label>
                <select name="company_id" id="company_id" 
                    class="rounded-lg border-gray-300 @error('company_id') border-red-500 @enderror">
                    <option value="">Select Company</option>
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                    @endforeach
                </select>
                @error('company_id')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="site_name" class="text-sm font-medium text-gray-700">Site Name</label>
                <input type="text" name="site_name" id="site_name" 
                    class="rounded-lg border-gray-300 @error('site_name') border-red-500 @enderror" 
                    value="{{ old('site_name') }}">
                @error('site_name')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="site_phone" class="text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" name="site_phone" id="site_phone" 
                    class="rounded-lg border-gray-300 @error('site_phone') border-red-500 @enderror" 
                    value="{{ old('site_phone') }}">
                @error('site_phone')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="site_email" class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="site_email" id="site_email" 
                    class="rounded-lg border-gray-300 @error('site_email') border-red-500 @enderror" 
                    value="{{ old('site_email') }}">
                @error('site_email')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="site_longitude" class="text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="site_longitude" id="site_longitude" 
                    class="rounded-lg border-gray-300 @error('site_longitude') border-red-500 @enderror" 
                    value="{{ old('site_longitude') }}">
                @error('site_longitude')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="site_latitude" class="text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="site_latitude" id="site_latitude" 
                    class="rounded-lg border-gray-300 @error('site_latitude') border-red-500 @enderror" 
                    value="{{ old('site_latitude') }}">
                @error('site_latitude')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Pin Location on Map</label>
                <div id="map" class="h-[400px] rounded-lg"></div>
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
                <label for="site_address" class="text-sm font-medium text-gray-700">Address</label>
                <textarea name="site_address" id="site_address" rows="3" 
                    class="rounded-lg border-gray-300 @error('site_address') border-red-500 @enderror" 
                    >{{ old('site_address') }}</textarea>
                @error('site_address')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="site_visibility" class="text-sm font-medium text-gray-700">Visibility</label>
                <select name="site_visibility" id="site_visibility" 
                    class="rounded-lg border-gray-300 @error('site_visibility') border-red-500 @enderror">
                    <option value="all" {{ old('site_visibility') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="private" {{ old('site_visibility') == 'private' ? 'selected' : '' }}>Private</option>
                </select>
                @error('site_visibility')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="site_status" class="text-sm font-medium text-gray-700">Status</label>
                <select name="site_status" id="site_status" 
                    class="rounded-lg border-gray-300 @error('site_status') border-red-500 @enderror">
                    <option value="1" {{ old('site_status') == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('site_status') == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('site_status')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-magenta-2 text-white text-sm rounded-full hover:bg-magenta-3">
                Save Site
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    $(document).ready(function() {
        var map = L.map('map', {
            tap: true,
            touchZoom: true
        }).setView([-6.200000, 106.816666], 10);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([-6.200000, 106.816666], {
            draggable: true
        }).addTo(map);

        // Update coordinates when marker is dragged
        marker.on('dragend', function(event) {
            var position = marker.getLatLng();
            updateCoordinates(position.lat, position.lng);
        });

        // Add click event to map
        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            updateCoordinates(e.latlng.lat, e.latlng.lng);
        });

        // Function to update coordinate inputs
        function updateCoordinates(lat, lng) {
            $('#site_latitude').val(lat.toFixed(6));
            $('#site_longitude').val(lng.toFixed(6));
        }

        // Handle manual coordinate input
        $('#site_latitude, #site_longitude').on('change', function() {
            var lat = parseFloat($('#site_latitude').val()) || -6.200000;
            var lng = parseFloat($('#site_longitude').val()) || 106.816666;
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
        });

        // Set initial marker position if coordinates exist
        if ($('#site_latitude').val() && $('#site_longitude').val()) {
            var lat = parseFloat($('#site_latitude').val());
            var lng = parseFloat($('#site_longitude').val());
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
        }
    });
</script>
@endpush
