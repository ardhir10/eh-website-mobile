@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center mb-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Details</h1>
            <p class="text-sm ">View complete user information</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('user-management.edit', $user->id) }}" 
               class="px-4 py-2 bg-blue-500 text-white text-sm rounded-full hover:bg-blue-600 flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit
            </a>
            <a href="{{ route('user-management.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Profile Section -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex flex-col items-center">
                    @if($user->avatar)
                        <img src="{{ Storage::url($user->avatar) }}" 
                             alt="{{ $user->name }}'s avatar" 
                             class="w-32 h-32 rounded-lg object-cover mb-4">
                    @else
                        <div class="w-32 h-32 rounded-lg bg-gray-200 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    @endif
                    <h2 class="text-xl font-semibold text-magenta-2">{{ $user->name }}</h2>
                    <p class=" text-sm">{{ $user->role }}</p>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-sm font-medium text-magenta-2">Account Status</span>
                        <span class="px-3 py-1 text-xs font-medium rounded-full {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-magenta-2">Member Since</span>
                        <span class="text-sm text-gray-900">{{ $user->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Information -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow">
                <!-- Account Information -->
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Account Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-magenta-2">Username</label>
                            <p class="text-gray-900">{{ $user->username }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-magenta-2">Email Address</label>
                            <p class="text-gray-900">{{ $user->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-magenta-2">Full Name</label>
                            <p class="text-gray-900">{{ $user->name }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-magenta-2">Role</label>
                            <p class="text-gray-900">{{ $user->role }}</p>
                        </div>
                    </div>
                </div>

                <!-- Company Information -->
                @if($user->company || !$user->isSuperAdmin())
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Company Information</h3>
                    @if($user->company)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="text-sm font-medium text-magenta-2">Company Name</label>
                                <p class="text-gray-900">{{ $user->company->company_name }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-magenta-2">Company Email</label>
                                <p class="text-gray-900">{{ $user->company->company_email }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-magenta-2">Company Phone</label>
                                <p class="text-gray-900">{{ $user->company->company_phone }}</p>
                            </div>
                            <div>
                                <label class="text-sm font-medium text-magenta-2">Company Address</label>
                                <p class="text-gray-900">{{ $user->company->company_address }}</p>
                            </div>
                        </div>
                    @else
                        <p class="text-magenta-2 italic">No company assigned</p>
                    @endif
                </div>
                @endif

                <!-- Activity Information -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Activity Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-sm font-medium text-magenta-2">Created At</label>
                            <p class="text-gray-900">{{ $user->created_at->format('M d, Y H:i:s') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-magenta-2">Last Updated</label>
                            <p class="text-gray-900">{{ $user->updated_at->format('M d, Y H:i:s') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-magenta-2">Last Login</label>
                            <p class="text-gray-900">{{ $user->last_login_at ? $user->last_login_at->format('M d, Y H:i:s') : 'Never' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 