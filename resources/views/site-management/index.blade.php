@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl">{{ $pageTitle ?? '' }}</h1>
        <a href="{{ route('site-management.create') }}" class="px-4 py-2 bg-magenta-2 text-white text-sm rounded-full hover:bg-magenta-3 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create Site
        </a>
    </div>

    {{-- Company Filter --}}
    <div class="w-64">
        <select id="companyFilter" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500">
            <option value="">All Companies</option>
            @foreach($companies as $company)
                <option value="{{ $company->company_name }}">{{ $company->company_name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Flash Message --}}
    <x-flash-message />
    
    <div class="overflow-x-auto">
        <table id="siteTable" class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs uppercase text-[#357AA6]">
                <tr>
                    <th scope="col" class="!px-2 !py-4">No</th>
                    <th scope="col" class="!px-2 !py-4">Company Name</th>
                    <th scope="col" class="!px-2 !py-4">Site Name</th>
                    <th scope="col" class="!px-2 !py-4">Address</th>
                    <th scope="col" class="!px-2 !py-4">Phone</th>
                    <th scope="col" class="!px-2 !py-4">Status</th>
                    <th scope="col" class="!px-2 !py-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sites as $site)
                    <tr class="bg-white border-b">
                        <td class="px-6 !py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 !py-3">{{ $site->company->company_name }}</td>
                        <td class="px-6 !py-3">{{ $site->site_name }}</td>
                        <td class="px-6 !py-3">
                            <div class="max-w-xs truncate" title="{{ $site->site_address }}">
                                {{ $site->site_address }}
                            </div>
                        </td>
                        <td class="px-6 !py-3">{{ $site->site_phone }}</td>
                        <td class="px-6 !py-3">
                            <span class="px-2 py-1 rounded-full text-xs {{ $site->site_status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $site->site_status ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 !py-3 space-x-2">
                            <a href="{{ route('site-management.show', $site) }}" 
                               class="text-green-500 hover:text-green-700">
                                <i class="fas fa-eye"></i> 
                            </a>
                            <a href="{{ route('site-management.edit', $site) }}" 
                               class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <form action="{{ route('site-management.destroy', $site->id) }}" 
                                  method="POST" 
                                  class="inline"
                                  onsubmit="return confirm('Are you sure you want to delete this site?');">
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
        $('#siteTable').DataTable({
            processing: true,
            dom: 'Bfrtip',
            stripeClasses: ['!bg-white', '!bg-gray-50'],
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i>&nbsp; EXCEL',
                    title: 'Sites Report',
                    className: 'btn btn-success btn-sm btn-corner',
                    titleAttr: 'Download as Excel'
                }, 
                {
                    extend: 'csv',
                    text: '<i class="fas fa-file-csv"></i>&nbsp; CSV',
                    title: 'Sites Report',
                    className: 'btn btn-info btn-sm btn-corner',
                    titleAttr: 'Download as Csv'
                }
            ]
        });

        // Add company filter functionality
        $('#companyFilter').on('change', function() {
            var table = $('#siteTable').DataTable();
            var selectedCompany = $(this).val();
            
            table.column(1) // Company Name column (index 1)
                .search(selectedCompany)
                .draw();
        });
    });
</script>
@endpush
