<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,500,700,700i,800,900|Roboto+Slab:300,400,500,600,700,800"
        rel="stylesheet">
    @vite('resources/css/app.css')
    <!-- <link rel="stylesheet" href="/gc_style.css?v=2"> -->
    @env('production')
    <script defer data-domain="rawl24.rawlingsbristol.co.uk" src="https://plausible.io/js/script.js"></script>
    @endenv
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="relative2 pt-28 antialiased lg:pt-40">

    {{--    @env(['local', 'production']) --}}
    {{--    <div class="absolute left-0 top-0 m-2 border-2 border-gray-700 p-1 text-xs font-bold"> --}}
    {{--        <a href="/designs" class="relative z-50"> --}}
    {{--            <div class="sm:hidden">XS</div> --}}
    {{--            <div class="hidden sm:inline-block md:hidden">SM</div> --}}
    {{--            <div class="hidden md:inline-block lg:hidden">MD</div> --}}
    {{--            <div class="hidden lg:inline-block xl:hidden">LG</div> --}}
    {{--            <div class="hidden xl:inline-block 2xl:hidden">XL</div> --}}
    {{--            <div class="hidden 2xl:inline-block">2XL</div> --}}
    {{--        </a> --}}
    {{--    </div> --}}
    {{--    @endenv --}}

    <x-partials.layout.topnav categories="" />

    {{ $slot }}

    <x-partials.layout.footer />

    <div class="text-yellow-50"></div>

</body>

</html>
