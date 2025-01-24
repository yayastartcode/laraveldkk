<?php

return [
    'tinymce' => [
        'api_key' => env('TINYMCE_API_KEY'),
        'options' => [
            'plugins' => [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            'toolbar' => 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            'relative_urls' => false,
            'remove_script_host' => false,
            'convert_urls' => true,
        ]
    ]
];
