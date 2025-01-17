<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="description" content="FixLab - Auto Repair Services" />
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <title>{{ $title ?? 'Dalbo Kencana Kreasi - Auto Repair Services' }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        :root {
            --header-height: 72px;
        }

        html {
            scroll-padding-top: var(--header-height);
        }

        body {
            min-height: 100vh;
        }
    </style>
</head>
<body class="font-sans text-gray-800 antialiased">
    @yield('content')
    
    @stack('scripts')
</body>
</html>
