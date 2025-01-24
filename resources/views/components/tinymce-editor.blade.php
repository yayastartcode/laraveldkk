@props(['name', 'value' => '', 'label' => null, 'required' => false])

@if($label)
    <label class="block text-sm font-medium text-yellow-400 mb-2">
        {{ $label }}
        @if($required)
            <span class="text-red-500">*</span>
        @endif
    </label>
@endif

<textarea
    name="{{ $name }}"
    id="editor-{{ $name }}"
    {{ $attributes->merge(['class' => 'tinymce w-full px-4 py-2 rounded bg-zinc-900 text-yellow-100 border border-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400']) }}
>{{ old($name, $value) }}</textarea>

@push('scripts')
<script src="https://cdn.tiny.cloud/1/{{ config('editor.tinymce.api_key') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#editor-{{ $name }}',
        ...@json(config('editor.tinymce.options')),
        skin: 'oxide-dark',
        content_css: 'dark',
        setup: function (editor) {
            editor.on('change', function () {
                editor.save(); // This will update the hidden textarea
                // Trigger form validation
                const textarea = document.getElementById('editor-{{ $name }}');
                textarea.dispatchEvent(new Event('change', { bubbles: true }));
            });
        },
        // Handle required validation
        init_instance_callback: function (editor) {
            const form = editor.getElement().form;
            if (form) {
                form.addEventListener('submit', function (e) {
                    if (editor.getContent().trim() === '' && editor.getElement().hasAttribute('required')) {
                        e.preventDefault();
                        alert('Please fill in the required content');
                        editor.focus();
                    }
                });
            }
        }
    });
</script>
@endpush
