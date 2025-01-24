@props(['name', 'value' => '', 'label' => null, 'required' => false])

@if($label)
    <label class="block text-sm font-medium text-yellow-400 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
@endif

<input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{{ old($name, $value) }}">
<trix-editor input="{{ $name }}" 
    {{ $attributes->merge(['class' => 'trix-content w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400']) }}
    x-data="{
        upload(event) {
            const data = new FormData()
            data.append('image', event.attachment.file)
            
            // Upload the image
            fetch('/admin/blogs/upload-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                body: data
            })
            .then(response => response.json())
            .then(data => {
                event.attachment.setAttributes({
                    url: data.url,
                    href: data.url
                })
            })
            .catch(error => {
                console.error('Error:', error)
                event.attachment.remove()
            })
        }
    }"
    @trix-attachment-add="upload($event)"
></trix-editor>

@push('styles')
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
<style>
    .trix-button-group--file-tools { display: none !important; }
    trix-editor {
        min-height: 15rem;
        @if($attributes->has('class'))
            {{ $attributes->get('class') }}
        @endif
    }
    .trix-content {
        color: #fef9c3 !important;
    }
    .trix-content h1 {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }
    .trix-content a {
        color: #facc15;
    }
    .trix-content ul {
        list-style-type: disc;
        margin-left: 1.5rem;
    }
    .trix-content ol {
        list-style-type: decimal;
        margin-left: 1.5rem;
    }
</style>
@endpush

@push('scripts')
<script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
@endpush
