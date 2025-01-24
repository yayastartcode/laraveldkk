@extends('layouts.admin')

@section('title', 'Manage Sliders')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-yellow-400">Manage Sliders</h1>
        <a href="{{ route('admin.sliders.create') }}" 
           class="bg-yellow-400 text-black px-4 py-2 rounded hover:bg-yellow-300">
            <i class="fas fa-plus mr-2"></i>Add New Slider
        </a>
    </div>

    <div class="bg-black rounded-lg shadow overflow-hidden">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b border-yellow-400/20">
                            <th class="pb-4 text-yellow-400">Order</th>
                            <th class="pb-4 text-yellow-400">Image</th>
                            <th class="pb-4 text-yellow-400">Title</th>
                            <th class="pb-4 text-yellow-400">Status</th>
                            <th class="pb-4 text-yellow-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="sliderTableBody">
                        @forelse($sliders as $slider)
                        <tr class="border-b border-yellow-400/10 slider-row" data-id="{{ $slider->_id }}">
                            <td class="py-4">
                                <input type="number" 
                                       value="{{ $slider->order }}" 
                                       class="w-16 px-2 py-1 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 order-input"
                                       min="0">
                            </td>
                            <td class="py-4">
                                <img src="{{ asset('storage/' . $slider->image) }}" 
                                     alt="{{ $slider->title }}" 
                                     class="w-20 h-12 object-cover rounded">
                            </td>
                            <td class="py-4 text-yellow-100">{{ $slider->title }}</td>
                            <td class="py-4">
                                <span class="px-2 py-1 rounded text-sm {{ $slider->is_active ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                                    {{ $slider->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" 
                                       class="text-yellow-400 hover:text-yellow-300">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Are you sure you want to delete this slider?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-yellow-400/60">No sliders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let orderTimeout;
    const orderInputs = document.querySelectorAll('.order-input');

    orderInputs.forEach(input => {
        input.addEventListener('change', function() {
            clearTimeout(orderTimeout);
            
            orderTimeout = setTimeout(() => {
                const orders = [];
                document.querySelectorAll('.slider-row').forEach(row => {
                    orders.push({
                        id: row.dataset.id,
                        order: row.querySelector('.order-input').value
                    });
                });

                fetch('{{ route("admin.sliders.updateOrder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ orders })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        // Optional: Show success message
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }, 500);
        });
    });
});
</script>
@endpush
@endsection
