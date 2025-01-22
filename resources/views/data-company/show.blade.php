@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center">
        <div class="flex items-center gap-4">
            @if($company->company_logo)
                <img src="{{ Storage::url($company->company_logo) }}" 
                     alt="{{ $company->company_name }} Logo" 
                     class="w-16 h-16 object-cover rounded-lg shadow-md">
            @else
                <div class="w-16 h-16 bg-gray-200 rounded-lg shadow-md flex items-center justify-center">
                    <i class="fas fa-building text-gray-400 text-3xl"></i>
                </div>
            @endif
            <h1 class="text-2xl">{{ $company->company_name }}</h1>
        </div>
        <a href="{{ route('data-company.index') }}" class="px-4 py-2 bg-gray-500 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6">
        <!-- Company Details Section -->
        <div>
            <div class="grid grid-cols-1 gap-4">
                <div class="border-b pb-4">
                    <h2 class="text-xl font-semibold text-gray-800 text-magenta-2">{{ $company->company_name }}</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Contact Information -->
                    <div class="space-y-3">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Phone Number</h3>
                            <p class="text-gray-800">{{ $company->company_phone }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Email</h3>
                            <p class="text-gray-800">{{ $company->company_email }}</p>
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="space-y-3">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Created At</h3>
                            <p class="text-gray-800">{{ $company->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Last Updated</h3>
                            <p class="text-gray-800">{{ $company->updated_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="space-y-2">
                    <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Address</h3>
                    <p class="text-gray-800">{{ $company->company_address }}</p>
                </div>

                <!-- Description -->
                <div class="space-y-2">
                    <h3 class="text-sm font-medium text-gray-500 text-magenta-2">Description</h3>
                    <p class="text-gray-800">{{ $company->company_description ?? 'No description available' }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex gap-3">
                <a href="{{ route('data-company.edit', $company->id) }}" 
                   class="px-4 py-2 bg-magenta-2 text-white text-sm rounded-full hover:bg-magenta-3 flex items-center gap-2">
                    <i class="fas fa-edit"></i>
                    Edit Company
                </a>
                <form action="{{ route('data-company.destroy', $company->id) }}" 
                      method="POST" 
                      onsubmit="return confirm('Are you sure you want to delete this company?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-gray-400 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2">
                        <i class="fas fa-trash"></i>
                        Delete Company
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 