@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl">{{ $pageTitle ?? '' }}</h1>
        <a href="{{ route('user-management.create') }}" class="px-4 py-2 bg-magenta-2 text-white text-sm rounded-full hover:bg-magenta-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create User
        </a>
    </div>

    {{-- Flash Message --}}
    <x-flash-message />
    
    <div class="overflow-x-auto">
        <table id="companyTable" class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs uppercase text-[#357AA6]">
                <tr>
                    <th scope="col" class="!px-2 !py-4">No</th>
                    <th scope="col" class="!px-2 !py-4">Avatar</th>
                    <th scope="col" class="!px-2 !py-4">Username</th>
                    <th scope="col" class="!px-2 !py-4">Name</th>
                    <th scope="col" class="!px-2 !py-4">Email</th>
                    <th scope="col" class="!px-2 !py-4">Role</th>
                    <th scope="col" class="!px-2 !py-4">Company</th>
                    <th scope="col" class="!px-2 !py-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="bg-white border-b">
                        <td class="px-6 !py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 !py-3">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" 
                                     alt="User Avatar" 
                                     class="w-10 h-10 object-cover rounded-full">
                            @else
                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 !py-3">{{ $user->username }}</td>
                        <td class="px-6 !py-3">{{ $user->name }}</td>
                        <td class="px-6 !py-3">{{ $user->email }}</td>
                        <td class="px-6 !py-3">
                            {{ $user->role }}
                        </td>
                        <td class="px-6 !py-3">
                            {{ $user->company->company_name ?? '-' }}
                        </td>
                        <td class="px-6 !py-3 space-x-2">
                            <a href="{{ route('user-management.show', $user->id) }}" 
                               class="text-green-500 hover:text-green-700">
                                <i class="fas fa-eye"></i> 
                            </a>
                            <a href="{{ route('user-management.edit', $user->id) }}" 
                               class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <form action="{{ route('user-management.destroy', $user->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#companyTable').DataTable({
            processing: true,
            // serverSide: true, // Enable if using server-side processing
            dom: 'Bfrtip',
            stripeClasses: ['!bg-white', '!bg-gray-50'],  // Add alternating row colors
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
                    title: 'Laporan Penugasan',
                    className: 'btn btn-success btn-sm btn-corner',
                    titleAttr: 'Download as Excel'
                }, 
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i>&nbsp; CSV',
                    title: 'Laporan Penugasan',
                    className: 'btn btn-info btn-sm btn-corner',
                    titleAttr: 'Download as Csv'
                }
            ]
        });
    });
</script>
@endpush
