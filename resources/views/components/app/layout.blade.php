<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])<!-- Alpine Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>

    <!-- Alpine Core -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @env('production')
        <script defer data-domain="redesign.rawlingsbristol.co.uk" src="https://plausible.io/js/script.js"></script>
    @endenv
</head>
<body x-data="{ hide_blip: false }" x-init="hide_blip=true" class="p-8 text-slate-600" x-cloak x-show="hide_blip">

{{ $slot }}

</body>
</html>
