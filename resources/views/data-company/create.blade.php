@extends('layouts.app')

@section('content')
<div class="flex flex-col gap-4 bg-white w-full rounded-2xl p-4">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl">Create Company</h1>
        <a href="{{ route('data-company.index') }}" class="px-4 py-2 bg-gray-500 text-white text-sm rounded-full hover:bg-gray-600 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back
        </a>
    </div>

    {{-- Flash Message --}}
    <x-flash-message />
    
    <form action="{{ route('data-company.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col gap-2">
                <label for="company_name" class="text-sm font-medium text-gray-700">Company Name</label>
                <input type="text" name="company_name" id="company_name" 
                    class="rounded-lg border-gray-300 @error('company_name') border-red-500 @enderror" 
                    value="{{ old('company_name') }}" >
                @error('company_name')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="company_phone" class="text-sm font-medium text-gray-700">Phone Number</label>
                <input type="tel" name="company_phone" id="company_phone" 
                    class="rounded-lg border-gray-300 @error('company_phone') border-red-500 @enderror" 
                    value="{{ old('company_phone') }}" >
                @error('company_phone')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="company_email" class="text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="company_email" id="company_email" 
                    class="rounded-lg border-gray-300 @error('company_email') border-red-500 @enderror" 
                    value="{{ old('company_email') }}" >
                @error('company_email')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="company_logo" class="text-sm font-medium text-gray-700">Company Logo</label>
                <input type="file" name="company_logo" id="company_logo" 
                    class="rounded-lg border border-gray-300 @error('company_logo') border-red-500 @enderror" 
                    accept="image/*">
                @error('company_logo')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
                <label for="company_address" class="text-sm font-medium text-gray-700">Address</label>
                <textarea name="company_address" id="company_address" rows="3" 
                    class="rounded-lg border-gray-300 @error('company_address') border-red-500 @enderror" 
                    >{{ old('company_address') }}</textarea>
                @error('company_address')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2 md:col-span-2">
                <label for="company_description" class="text-sm font-medium text-gray-700">Description</label>
                <textarea name="company_description" id="company_description" rows="3" 
                    class="rounded-lg border-gray-300 @error('company_description') border-red-500 @enderror"
                    >{{ old('company_description') }}</textarea>
                @error('company_description')
                    <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-magenta-2 text-white text-sm rounded-full hover:bg-magenta-3">
                Save Company
            </button>
        </div>
    </form>
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
