@extends('layouts.app')

@section('content')
<div class="p-6" x-data="{ drawerOpen: false, startY: 0, currentHeight: 0, isDragging: false, initialHeight: 0 }">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Users Management</h1>
        <p class="mt-1 text-sm text-gray-600">Manage all users in your system</p>
    </div>

    <!-- Action Buttons -->
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 sm:gap-2">
        <div class="flex flex-wrap gap-2 max-sm:w-full">
            <x-button 
                variant="primary"
                @click="drawerOpen = true"
                class="max-sm:w-full"
            >
                Add New User
            </x-button>

            <x-dropdown align="left" width="200">
                <x-slot name="trigger">
                    <x-button variant="secondary" class="max-sm:w-full">
                        <span>Export Users</span>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </x-button>
                </x-slot>

                <x-dropdown-item href="{{ route('dashboard.users.export', ['format' => 'xlsx']) }}">
                    Export as Excel (.xlsx)
                </x-dropdown-item>
                
                <x-dropdown-item href="{{ route('dashboard.users.export', ['format' => 'csv']) }}">
                    Export as CSV
                </x-dropdown-item>
                
                <x-dropdown-item href="{{ route('dashboard.users.export', ['format' => 'pdf']) }}">
                    Export as PDF
                </x-dropdown-item>
            </x-dropdown>
        </div>
        
        <x-search-input
            placeholder="Search users..."
            @input="searchUsers($event.target.value)"
            width="auto"
        />
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="overflow-x-auto w-full rounded-xl">
            @if($users->count() > 0)
                <table class="w-full text-sm text-left min-w-[800px]" id="users-table">
                    <thead class="bg-gray-50 text-gray-600">
                        <tr>
                            <th class="px-4 py-3 font-medium">No</th>
                            <th class="px-4 py-3 font-medium">Name</th>
                            <th class="px-4 py-3 font-medium">Email</th>
                            <th class="px-4 py-3 font-medium">Status</th>
                            <th class="px-4 py-3 font-medium">Joined Date</th>
                            <th class="px-4 py-3 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 overflow-hidden" id="users-table-body">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-2 sm:px-4 py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-2 sm:px-4 py-3">
                                <div class="flex items-center gap-2 sm:gap-3">
                                    <img src="{{ asset('/assets/images/avatars/1.gif') }}" 
                                         alt="{{ $user->name }}" 
                                         class="size-6 sm:size-8 rounded-full">
                                    <div>
                                        <p class="font-medium text-gray-700 text-xs sm:text-sm">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500 hidden sm:block">ID: #{{ $user->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2 sm:px-4 py-3 text-gray-600 text-xs sm:text-sm">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    Active
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <button class="p-1 text-gray-500 hover:text-gray-700 transition-colors">
                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </button>
                                    <button data-delete-url="{{ route('dashboard.users.destroy', $user->id) }}"
                                            class="p-1 text-gray-500 hover:text-red-500 transition-colors">
                                        <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="flex flex-col items-center justify-center py-8 sm:py-12 px-4">
                    <svg class="size-12 sm:size-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <p class="text-gray-500 text-base sm:text-lg font-medium text-center">No users found</p>
                    <p class="text-gray-400 text-xs sm:text-sm mt-1 text-center">Start by adding a new user using the button above</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if($users->count() > 0)
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $users->links('vendor.pagination.custom') }}
            </div>
        @endif
        
    </div>

    <!-- Add User Drawer -->
    <x-drawer title="Add New User">
        <div class="px-3 sm:px-4 py-4 sm:py-6">
            <form
                action="{{ route('dashboard.users.store') }}"
                method="POST" 
                class="flex flex-col h-full"
                id="add-user-form"
                data-ajax="true"
                enctype="multipart/form-data"
            >
                @csrf
                
                <div class="flex-1">
                    <x-input 
                        label="Name"
                        name="name"
                        placeholder="Enter user name"
                        :error="$errors->first('name')"
                    />

                    <x-input 
                        label="Email"
                        type="email"
                        name="email"
                        placeholder="Enter email address"
                        :error="$errors->first('email')"
                    />

                    <x-input 
                        label="Password"
                        type="password"
                        name="password"
                        placeholder="Enter password"
                        :error="$errors->first('password')"
                    />

                    <x-select
                        label="Role"
                        name="role"
                        :options="[
                            'user' => 'Regular User',
                            'admin' => 'Administrator',
                            'moderator' => 'Moderator'
                        ]"
                        placeholder="Select user role"
                        :selected="old('role')"
                        :error="$errors->first('role')"
                    />

                    <x-select
                        label="Status"
                        name="status"
                        :options="[
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                            'suspended' => 'Suspended'
                        ]"
                        placeholder="Select user status"
                        :selected="old('status')"
                        :error="$errors->first('status')"
                    />
                </div>

                <!-- Footer -->
                <div class="flex flex-shrink-0 px-4 py-4 border-t border-gray-200">
                    <x-button 
                        variant="secondary"
                        @click="drawerOpen = false"
                        class="mr-2 bg-slate-100 hover:bg-slate-200"
                    >
                        Cancel
                    </x-button>
                    <x-button 
                        type="submit"
                        variant="primary"
                        class="flex-1"
                        data-ajax="true"
                    >
                        Save User
                    </x-button>
                </div>
            </form>
        </div>
    </x-drawer>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search users
    window.searchUsers = function(query, page = 1) {
        query = query.toLowerCase();
        let url = '/dashboard/users/search';
        
        // Add query parameters if exist
        const params = new URLSearchParams();
        if (query && query.length > 0) params.append('q', query);
        params.append('page', page);
        
        // Tambahkan per_page ke parameter
        const perPage = document.querySelector('select[onchange]').value.match(/per_page=(\d+)/)?.[1] || 10;
        params.append('per_page', perPage);
        
        if (params.toString()) url += `?${params.toString()}`;
        
        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(response => {
                updateUsersTable(response.data);
                updatePagination(response.pagination);
            })
            .catch(handleSearchError);
    };

    // Add new function to handle pagination
    function updatePagination(pagination) {
        const paginationContainer = document.querySelector('.pagination');
        if (!paginationContainer) return;

        if (pagination.last_page > 1) {
            // Show pagination controls
            let html = '';
            for (let i = 1; i <= pagination.last_page; i++) {
                html += `
                    <button 
                        class="px-3 py-1 ${pagination.current_page === i ? 'bg-blue-500 text-white' : 'bg-gray-100'}"
                        onclick="searchUsers(document.querySelector('#search-input').value, ${i})"
                    >
                        ${i}
                    </button>
                `;
            }
            paginationContainer.innerHTML = html;
            paginationContainer.classList.remove('hidden');
        } else {
            // Hide pagination if only 1 page
            paginationContainer.classList.add('hidden');
        }
    }

    // Update your existing updateUsersTable function to handle the new data structure
    function updateUsersTable(users) {
        const usersTableBody = document.getElementById('users-table-body');
        
        if (users.length === 0) {
            usersTableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                        No users found
                    </td>
                </tr>
            `;
            return;
        }

        usersTableBody.innerHTML = users.map((user, index) => `
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3">
                    ${user.id}
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        <img src="/assets/images/avatars/1.gif" alt="${user.name}" class="size-8 rounded-full">
                        <div>
                            <p class="font-medium text-gray-700">${user.name}</p>
                            <p class="text-xs text-gray-500">ID: #${user.id}</p>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-600">${user.email}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                        ${user.status}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-600">
                    ${new Date(user.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })}
                </td>
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <button class="p-1 text-gray-500 hover:text-gray-700 transition-colors">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>
                        <button data-delete-url="${user.delete_url}"
                                class="p-1 text-gray-500 hover:text-red-500 transition-colors">
                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    }

    // Helper function untuk handle error
    function handleSearchError(error) {
        console.error('Error:', error);
        const usersTableBody = document.getElementById('users-table-body');
        usersTableBody.innerHTML = `
            <tr>
                <td colspan="6" class="px-4 py-8 text-center text-red-500">
                    Error occurred while searching. Please try again.
                </td>
            </tr>
        `;
    }

    // Handle form submission success specifically for add user form
    $('#add-user-form').on('submit', function() {
        $(this).data('success-callback', function() {
            // Close drawer using Alpine.js
            Alpine.store('drawer', { drawerOpen: false });
        });
    });
});
</script>
@endsection 