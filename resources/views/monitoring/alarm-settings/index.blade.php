@extends('monitoring.partials.app')

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="flex flex-col gap-4 w-full">
        <div class="flex flex-col gap-1">
            <h1 class="mt-2 text-xl font-semibold text-gray-900">Alarm Thresholds Settings</h1>
            <p class="mt-0.5 text-xs text-gray-600">Configure alarm thresholds for monitoring parameters</p>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <!-- Add Button -->
            <div class="mb-6">
                <button onclick="openAddModal()" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">
                    Add New Alarm Threshold
                </button>
            </div>

            <!-- Existing Alarm Settings -->
            <div>
                <h2 class="text-lg font-semibold mb-4">Existing Alarm Settings</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Site</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Parameter</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Formula</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Set Point</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($alarmSettings as $alarm)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $alarm->site->site_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $alarm->parameter }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $alarm->formula }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $alarm->set_point }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($alarm->status)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $alarm->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button onclick="openEditModal({{ $alarm->id }})" class="text-blue-600 hover:text-blue-900">Edit</button>
                                    <form action="{{ route('monitoring.alarm-settings.destroy', $alarm->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="ml-2 text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Modal -->
    <div id="alarmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-medium leading-6 text-gray-900 mb-4">Add Alarm Setting</h3>
                <form id="alarmForm" method="POST" class="space-y-4">
                    @csrf
                    <div id="methodField"></div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Site</label>
                        <select name="site_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}">{{ $site->site_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Parameter</label>
                        <select name="parameter" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="ph">pH</option>
                            <option value="tss">TSS</option>
                            <option value="nh3n">NH3N</option>
                            <option value="cod">COD</option>
                            <option value="debit">Debit</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Formula</label>
                        <select name="formula" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value=">">&gt;</option>
                            <option value=">=">&gt;=</option>
                            <option value="<">&lt;</option>
                            <option value="<=">&lt;=</option>
                            <option value="=">=</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Set Point</label>
                        <input type="number" step="0.01" name="set_point" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded-md hover:bg-pink-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function openAddModal() {
    const form = document.getElementById('alarmForm');
    form.reset();
    form.action = "{{ route('monitoring.alarm-settings.store') }}";
    document.getElementById('modalTitle').textContent = 'Add Alarm Setting';
    document.getElementById('methodField').innerHTML = '';
    document.getElementById('alarmModal').classList.remove('hidden');
}

function openEditModal(alarmId) {
    fetch("{{ route('monitoring.alarm-settings.show', '') }}/" + alarmId)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const form = document.getElementById('alarmForm');
            form.action = "{{ route('monitoring.alarm-settings.update', '') }}/" + alarmId;
            document.getElementById('methodField').innerHTML = '@method("PUT")';
            document.getElementById('modalTitle').textContent = 'Edit Alarm Setting';
            
            // Fill form fields with existing data
            form.querySelector('[name="site_id"]').value = data.site_id;
            form.querySelector('[name="parameter"]').value = data.parameter;
            form.querySelector('[name="formula"]').value = data.formula;
            form.querySelector('[name="set_point"]').value = data.set_point;
            form.querySelector('[name="description"]').value = data.description || '';
            form.querySelector('[name="status"]').value = data.status ? "1" : "0";
            
            document.getElementById('alarmModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to load alarm setting data');
        });
}

function closeModal() {
    document.getElementById('alarmModal').classList.add('hidden');
}
</script>
@endpush
