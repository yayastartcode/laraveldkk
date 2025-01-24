@extends('layouts.admin')

@section('title', 'Services')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">Services</h1>
        <a href="{{ route('admin.services.create') }}" 
           class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
            Add New Service
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/10 border border-green-500 text-green-500 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-500/10 border border-red-500 text-red-500 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-black rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-yellow-400/10">
            <thead class="bg-yellow-400/5">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Image</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Icon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-yellow-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-yellow-400/10" id="sortable-services">
                @foreach($services as $service)
                    <tr class="hover:bg-yellow-400/5" data-id="{{ $service->_id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-400">
                            <i class="fas fa-grip-vertical cursor-move mr-2"></i>
                            <span class="order-number">{{ $service->order }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($service->image)
                                <img src="{{ asset('storage/' . $service->image) }}" 
                                     alt="{{ $service->title }}" 
                                     class="h-10 w-10 rounded object-cover">
                            @else
                                <span class="text-yellow-400/50">No image</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-400">
                            {{ $service->title }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-400">
                            <i class="{{ $service->icon }}"></i>
                            <span class="ml-2">{{ $service->icon }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                       {{ $service->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-yellow-400">
                            <a href="{{ route('admin.services.edit', $service) }}" 
                               class="text-blue-400 hover:text-blue-300 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.services.destroy', $service) }}" 
                                  method="POST" 
                                  class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-400 hover:text-red-300"
                                        onclick="return confirm('Are you sure you want to delete this service?')">
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var el = document.getElementById('sortable-services');
    var sortable = new Sortable(el, {
        animation: 150,
        handle: '.fa-grip-vertical',
        onEnd: function() {
            let items = [];
            document.querySelectorAll('#sortable-services tr').forEach((row, index) => {
                items.push({
                    id: row.dataset.id,
                    order: index
                });
                row.querySelector('.order-number').textContent = index;
            });

            fetch('{{ route("admin.services.updateOrder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ items })
            });
        }
    });
});
</script>
@endpush
@endsection
