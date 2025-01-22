@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Create New User</h1>
            <p class="text-sm text-gray-500">Add a new user to the system</p>
        </div>
        <a href="{{ route('user-management.index') }}" 
           class="px-4 py-2 bg-gray-500 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
    </div>

    <x-flash-message />
    
    <form action="{{ route('user-management.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-white rounded-lg">
            <!-- Account Information Section -->
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Account Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Username -->
                    <div class="flex flex-col gap-2">
                        <label for="username" class="text-sm font-medium text-gray-700">Username <span class="text-red-500">*</span></label>
                        <input type="text" name="username" id="username" 
                            class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('username') border-red-500 @enderror" 
                            value="{{ old('username') }}"
                            placeholder="Enter username">
                        @error('username')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Username must be 4-20 characters and may contain letters, numbers, dashes and underscores.</p>
                    </div>

                    <!-- Email -->
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-sm font-medium text-gray-700">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" 
                            class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror" 
                            value="{{ old('email') }}"
                            placeholder="Enter email address">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div class="flex flex-col gap-2">
                        <label for="name" class="text-sm font-medium text-gray-700">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" 
                            class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                            value="{{ old('name') }}"
                            placeholder="Enter full name">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div class="flex flex-col gap-2">
                        <label for="role" class="text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                        <select name="role" id="role" 
                            class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('role') border-red-500 @enderror"
                            onchange="toggleCompanyField()">
                            <option value="">Select Role</option>
                            @foreach(App\Models\User::getRoles() as $value => $label)
                                <option value="{{ $value }}" {{ old('role') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Company Information Section -->
            <div class="border-b border-gray-200 pb-4 mb-4" id="company-field">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Company Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label for="company_id" class="text-sm font-medium text-gray-700">Company <span class="text-red-500">*</span></label>
                        <select name="company_id" id="company_id" 
                            class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('company_id') border-red-500 @enderror">
                            <option value="">Select Company</option>
                            @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->company_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('company_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Required for Admin Company and Operator roles</p>
                    </div>
                </div>
            </div>

            <!-- Security Section -->
            <div class="border-b border-gray-200 pb-4 mb-4">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Security</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password -->
                    <div class="flex flex-col gap-2">
                        <label for="password" class="text-sm font-medium text-gray-700">Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password" id="password" 
                            class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 @error('password') border-red-500 @enderror"
                            placeholder="Enter password">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500">Must be at least 6 characters and contain both letters and numbers</p>
                    </div>

                    <!-- Confirm Password -->
                    <div class="flex flex-col gap-2">
                        <label for="password_confirmation" class="text-sm font-medium text-gray-700">Confirm Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Confirm password">
                    </div>
                </div>
            </div>

            <!-- Profile Picture Section -->
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Profile Picture</h2>
                <div class="flex flex-col gap-2">
                    <label for="avatar" class="text-sm font-medium text-gray-700">Avatar</label>
                    <input type="file" name="avatar" id="avatar" 
                        class="rounded-lg border border-gray-300 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('avatar') border-red-500 @enderror" 
                        accept="image/*">
                    <p class="text-xs text-gray-500">Accepted formats: JPG, JPEG, PNG. Max size: 2MB</p>
                    @error('avatar')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex justify-end gap-3">
                <a href="{{ route('user-management.index') }}" 
                   class="px-6 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-full hover:bg-gray-200 transition-colors">
                    Cancel
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-magenta-2 text-white text-sm font-medium rounded-full hover:bg-magenta-2/90 transition-colors">
                    Create User
                </button>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
function toggleCompanyField() {
    const roleSelect = document.getElementById('role');
    const companyField = document.getElementById('company-field');
    
    if (roleSelect.value === '{{ App\Models\User::ROLE_SUPER_ADMIN }}') {
        companyField.style.display = 'none';
        document.getElementById('company_id').value = '';
    } else {
        companyField.style.display = 'block';
    }
}

// Run on page load
document.addEventListener('DOMContentLoaded', function() {
    toggleCompanyField();
});
</script>
@endpush
@endsection
