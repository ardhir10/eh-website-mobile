@extends('dashboard.layouts.app')

@section('content')
<div class="tw-p-6" x-data="{ drawerOpen: false, startY: 0, currentHeight: 0, isDragging: false, initialHeight: 0 }">
    <!-- Header -->
    <div class="tw-mb-6">
        <h1 class="tw-text-2xl tw-font-semibold tw-text-gray-900">Users Management</h1>
        <p class="tw-mt-1 tw-text-sm tw-text-gray-600">Manage all users in your system</p>
    </div>

    <!-- Action Buttons -->
    <div class="tw-mb-6 tw-flex tw-flex-col sm:tw-flex-row tw-justify-between tw-items-start sm:tw-items-center tw-gap-4 sm:tw-gap-2">
        <div class="tw-flex tw-flex-wrap tw-gap-2 max-sm:tw-w-full">
            <x-button 
                variant="primary"
                @click="drawerOpen = true"
                class="max-sm:tw-w-full"
            >
                Add New User
            </x-button>

            <x-dropdown align="left" width="200">
                <x-slot name="trigger">
                    <x-button variant="secondary" class="max-sm:tw-w-full">
                        <span>Export Users</span>
                        <svg class="tw-w-4 tw-h-4 tw-ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
    <div class="tw-bg-white tw-rounded-xl tw-shadow-sm tw-border tw-border-gray-100">
        <div class="tw-overflow-x-auto tw-w-full tw-rounded-xl">
            @if($users->count() > 0)
                <table class="tw-w-full tw-text-sm tw-text-left tw-min-w-[800px]" id="users-table">
                    <thead class="tw-bg-gray-50 tw-text-gray-600">
                        <tr>
                            <th class="tw-px-4 tw-py-3 tw-font-medium">No</th>
                            <th class="tw-px-4 tw-py-3 tw-font-medium">Name</th>
                            <th class="tw-px-4 tw-py-3 tw-font-medium">Email</th>
                            <th class="tw-px-4 tw-py-3 tw-font-medium">Status</th>
                            <th class="tw-px-4 tw-py-3 tw-font-medium">Joined Date</th>
                            <th class="tw-px-4 tw-py-3 tw-font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="tw-divide-y tw-divide-gray-100 tw-overflow-hidden" id="users-table-body">
                        @foreach($users as $user)
                        <tr class="hover:tw-bg-gray-50">
                            <td class="tw-px-2 sm:tw-px-4 tw-py-3">
                                {{ $loop->iteration }}
                            </td>
                            <td class="tw-px-2 sm:tw-px-4 tw-py-3">
                                <div class="tw-flex tw-items-center tw-gap-2 sm:tw-gap-3">
                                    <img src="{{ asset('/assets/images/avatars/1.gif') }}" 
                                         alt="{{ $user->name }}" 
                                         class="tw-size-6 sm:tw-size-8 tw-rounded-full">
                                    <div>
                                        <p class="tw-font-medium tw-text-gray-700 tw-text-xs sm:tw-text-sm">{{ $user->name }}</p>
                                        <p class="tw-text-xs tw-text-gray-500 tw-hidden sm:tw-block">ID: #{{ $user->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="tw-px-2 sm:tw-px-4 tw-py-3 tw-text-gray-600 tw-text-xs sm:tw-text-sm">{{ $user->email }}</td>
                            <td class="tw-px-4 tw-py-3">
                                <span class="tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-rounded-full tw-bg-green-100 tw-text-green-700">
                                    Active
                                </span>
                            </td>
                            <td class="tw-px-4 tw-py-3 tw-text-gray-600">
                                {{ $user->created_at->format('M d, Y') }}
                            </td>
                            <td class="tw-px-4 tw-py-3">
                                <div class="tw-flex tw-items-center tw-gap-2">
                                    <button class="tw-p-1 tw-text-gray-500 hover:tw-text-gray-700 tw-transition-colors">
                                        <svg class="tw-size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </button>
                                    <button data-delete-url="{{ route('dashboard.users.destroy', $user->id) }}"
                                            class="tw-p-1 tw-text-gray-500 hover:tw-text-red-500 tw-transition-colors">
                                        <svg class="tw-size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-py-8 sm:tw-py-12 tw-px-4">
                    <svg class="tw-size-12 sm:tw-size-16 tw-text-gray-400 tw-mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <p class="tw-text-gray-500 tw-text-base sm:tw-text-lg tw-font-medium tw-text-center">No users found</p>
                    <p class="tw-text-gray-400 tw-text-xs sm:tw-text-sm tw-mt-1 tw-text-center">Start by adding a new user using the button above</p>
                </div>
            @endif
        </div>
        
        <!-- Pagination -->
        @if($users->count() > 0)
            <div class="tw-px-4 tw-py-3 tw-border-t tw-border-gray-100">
                {{ $users->links('vendor.pagination.custom') }}
            </div>
        @endif
        
    </div>

    <!-- Add User Drawer -->
    <x-drawer title="Add New User">
        <div class="tw-px-3 sm:tw-px-4 tw-py-4 sm:tw-py-6">
            <form
                action="{{ route('dashboard.users.store') }}"
                method="POST" 
                class="tw-flex tw-flex-col tw-h-full"
                id="add-user-form"
                data-ajax="true"
                enctype="multipart/form-data"
            >
                @csrf
                
                <div class="tw-flex-1">
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
                <div class="tw-flex tw-flex-shrink-0 tw-px-4 tw-py-4 tw-border-t tw-border-gray-200">
                    <x-button 
                        variant="secondary"
                        @click="drawerOpen = false"
                        class="tw-mr-2 tw-bg-slate-100 hover:tw-bg-slate-200"
                    >
                        Cancel
                    </x-button>
                    <x-button 
                        type="submit"
                        variant="primary"
                        class="tw-flex-1"
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
                        class="tw-px-3 tw-py-1 ${pagination.current_page === i ? 'tw-bg-blue-500 tw-text-white' : 'tw-bg-gray-100'}"
                        onclick="searchUsers(document.querySelector('#search-input').value, ${i})"
                    >
                        ${i}
                    </button>
                `;
            }
            paginationContainer.innerHTML = html;
            paginationContainer.classList.remove('tw-hidden');
        } else {
            // Hide pagination if only 1 page
            paginationContainer.classList.add('tw-hidden');
        }
    }

    // Update your existing updateUsersTable function to handle the new data structure
    function updateUsersTable(users) {
        const usersTableBody = document.getElementById('users-table-body');
        
        if (users.length === 0) {
            usersTableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="tw-px-4 tw-py-8 tw-text-center tw-text-gray-500">
                        No users found
                    </td>
                </tr>
            `;
            return;
        }

        usersTableBody.innerHTML = users.map((user, index) => `
            <tr class="hover:tw-bg-gray-50">
                <td class="tw-px-4 tw-py-3">
                    ${user.id}
                </td>
                <td class="tw-px-4 tw-py-3">
                    <div class="tw-flex tw-items-center tw-gap-3">
                        <img src="/assets/images/avatars/1.gif" alt="${user.name}" class="tw-size-8 tw-rounded-full">
                        <div>
                            <p class="tw-font-medium tw-text-gray-700">${user.name}</p>
                            <p class="tw-text-xs tw-text-gray-500">ID: #${user.id}</p>
                        </div>
                    </div>
                </td>
                <td class="tw-px-4 tw-py-3 tw-text-gray-600">${user.email}</td>
                <td class="tw-px-4 tw-py-3">
                    <span class="tw-px-2 tw-py-1 tw-text-xs tw-font-medium tw-rounded-full tw-bg-green-100 tw-text-green-700">
                        ${user.status}
                    </span>
                </td>
                <td class="tw-px-4 tw-py-3 tw-text-gray-600">
                    ${new Date(user.created_at).toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' })}
                </td>
                <td class="tw-px-4 tw-py-3">
                    <div class="tw-flex tw-items-center tw-gap-2">
                        <button class="tw-p-1 tw-text-gray-500 hover:tw-text-gray-700 tw-transition-colors">
                            <svg class="tw-size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </button>
                        <button data-delete-url="${user.delete_url}"
                                class="tw-p-1 tw-text-gray-500 hover:tw-text-red-500 tw-transition-colors">
                            <svg class="tw-size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                <td colspan="6" class="tw-px-4 tw-py-8 tw-text-center tw-text-red-500">
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