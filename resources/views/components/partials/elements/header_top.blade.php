@props(['tag' => 'h1'])

<{{ $tag }} {{ $attributes->merge(['class' => 'font-extrabold font-gilroy']) }} >
{{ $slot }}
</{{ $tag }}>
